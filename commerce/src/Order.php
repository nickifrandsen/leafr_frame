<?php

namespace Leafr\Commerce;

use Leafr\Core\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Event;
use Nickifrandsen\Leafr\Jobs\SendOrderProcessingEmail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Order extends Model
{

    use DispatchesJobs;

    protected $table = 'orders';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
    * Which fields should be allowed to be mass assigned
    *
    * @var array
    */
    protected $fillable = [
        'order_no' ,
        'invoice_no' ,
        'total',
        'subtotal',
        'shipping' ,
        'discount',
        'voucher' ,
        'status',
        'track_and_trace',
        'notes',
        'delivery_name',
        'delivery_address',
        'delivery_zipcode',
        'delivery_city',
        'customer_id',
        'json_product_lines',
        'parcel_shop',
        'shipping_method_id',
        'parcel_no'
    ];

    public function customer()
    {
        return $this->belongsTo('Leafr\Commerce\Customer');
    }

    public function products()
    {
        return $this->hasMany('Leafr\Commerce\OrderProduct');
    }

    public function shipping_method()
    {
        return $this->belongsTo('Leafr\Commerce\Shipping', 'shipping_method_id');
    }

    public function placeOrder($attr, $status = 'init')
    {

        $customer = new Customer;

        $customer->fill([
            'first_name'        => $attr['first_name'],
            'last_name'         => $attr['last_name'],
            'address'           => $attr['address'],
            'zipcode'           => $attr['zipcode'],
            'city'              => $attr['city'],
            'country'           => 'DK',

            'email'             => $attr['email'],
            'phone'             => $attr['phone'],

            'on_mailinglist'    => isset($attr['on_mailinglist']) ? $attr['on_mailinglist'] : 0
        ]);

        if(!$customer->save()) {
            return 'Failed to create customer.';
        }

        $this->order_no = Setting::get_option('store_order_number'); // Retrieve the current order no from the settings db
        $this->total = (float) Cart::total();
        $this->subtotal = (float) Cart::subtotal();
        // $this->shipping = Cart::shipping()->unit_price;
        // $this->discount = abs(Cart::getDiscountsValue());
        $this->status = $status;
        $this->notes = isset($attr['notes']) ? $attr['notes'] : '';
        $this->delivery_name = $customer->name;
        $this->delivery_address = $customer->address;
        $this->delivery_zipcode = $customer->zipcode;
        $this->delivery_city = $customer->city;
        $this->delivery_country = $customer->country;
        $this->parcel_shop = $attr['parcel_shop'];
        $this->shipping_method_id = 1; // Cart::shipping()->id;
        $this->customer_id = $customer->id;
        $this->json_product_lines = Cart::content();

        if(!$this->save()) {
            return 'Failed to create order.';
        }

        $this->saveOrderNumToSettings(); // Increments the order_no storerd in the settings table

        foreach (Cart::content() as $item) {
            if($sku = $item->model) {

                $product = (new OrderProduct)->fill([
                    'product_id'    => $sku->product_id,
                    'sku'           => $sku->sku,
                    'description'   => $sku->product->name,
                    'quantity'      => $item->qty,
                    'unit_price'    => $sku->unit_price,
                    'subtotal'      => $item->qty * $sku->unit_price,
                    'variations'    => $item->options
                ]);

                if (!$this->products()->save($product)) {
                    break;
                }
            }
        }

        Cart::destroy();

        return $this;
    }

    public static function getIncompleteOrders()
    {
        return static::where('status', 'incomplete')->get();
    }

    public static function getAllOrders()
    {
        return static::where('status', '!=' ,'incomplete')->orderBy('created_at','desc')->get();
    }

    public static function getOrdersByStatus($status)
    {
        return static::where('status', '=' ,$status)->orderBy('created_at','desc')->get();
    }

    public function getItemsAttribute()
    {
        $items = 0;

        foreach ($this->products as $product) {
            $items = $product->quantity + $items;
        }

        return $items;
    }

    public function getAllStatuses() {
        $statuses = collect([
            'init'      => 'Ufuldstændig',
            'unpaid'    => 'Betaling mangler',
            'payed'     => 'Ny',
            'processing'=> 'Behandles',
            'sent'      => 'Afsendt',
            'complete'  => 'Afsluttet',
            'cancelled' => 'Annulleret'
        ]);

        return $statuses;
    }

    public function getStatusTextAttribute()
    {
        return self::getStatusText($this->status);
    }

    public static function getStatusText($status)
    {

        switch($status) {
            case 'init':
            return 'Ufuldstændig';
            case 'payed':
            return 'Ny';
            case 'unpaid':
            return 'Betaling mangler';
            case 'processing':
            return 'Behandles';
            case 'sent':
            return 'Afsendt';
            case 'complete':
            return 'Afsluttet';
            case 'cancelled':
            return 'Annulleret';
            default :
            return 'N/A';
        }
    }

    public function getPublicUrlAttribute()
    {
        return Crypt::encrypt(strtotime($this->created_at) . '-' . $this->order_no);
    }

    public function setParcelShopAttribute($value)
    {
        if (empty($value) && $value == 0) { // will check for empty string, null values, see php.net about it
            $this->attributes['parcel_shop'] = NULL;
        } else {
            $this->attributes['parcel_shop'] = $value;
        }
    }

    public function setTrackAndTraceAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['track_and_trace'] = '';
        } else {
            $this->attributes['track_and_trace'] = str_replace('[PARCELNO]', $value, $this->shipping_method->tracking_url);
        }
    }

    public function updateStatus($status) {

        $this->attributes['status'] = $status;

        $this->dispatch(new SendOrderProcessingEmail($this));

        return $this->save();
    }

    public function shippingLabel()
    {
        $client = new GuzzleHttp\Client;

        $data = [
            "UserName" => Setting::get_option('shipping_gls_username'),
            "Password" => Setting::get_option('shipping_gls_password'),
            "CustomerId" => Setting::get_option('shipping_gls_customer_id'),
            "ContactId" => Setting::get_option('shipping_gls_contact_id'),
            "ShipmentDate" => date('Ymd'),
            "Reference" => 'Ref: ' . $this->order_no,
            "Addresses" => [
                "Delivery" => [
                    "Name1" => 1722,
                    "Name2" => $this->customer->name,
                    "Street1"=> $this->delivery_address,
                    "CountryNum" => "208",
                    "ZipCode" => $$this->delivery_zipcode,
                    "City" => $this->delivery_city,
                    "Contact" => $this->customer->name,
                    "Email" => $this->customer->email,
                    "Phone" => $this->customer->phone,
                    "Mobile" => $this->customer->phone
                ]
            ],
            "Parcels" => [
                [
                    "Weight" => 1.000
                ]
            ]
        ];

        if($this->parcel_shop) {
            $data['Services'] = ["Shopdelivery" =>  $this->parcel_shop];
        } else {
            $data['Services'] = ["PrivateDelivery" => 'Y'];
        }

        $request = $client->request('POST','https://api.gls.dk/ws/DK/V1/CreateShipment', ['json' => $data]);
        $body = $request->getBody();
        $response = json_decode($body);

        $this->parcel_no = array_shift($response->Parcels)->ParcelNumber;
        $this->track_and_trace = $order->parcel_no;
        $this->save();

        return Response::make(base64_decode($response->PDF))->header('Content-Type', 'application/pdf');

    }

    /**
    * Updates the value of order number stored in the settings table
    *
    * @return [type] [description]
    */
    private function saveOrderNumToSettings()
    {
        $orderNo = Setting::where('key', '=', 'store_order_number')->first();

        $orderNo->value = $this->order_no + 1;

        return $orderNo->save();
    }


}
