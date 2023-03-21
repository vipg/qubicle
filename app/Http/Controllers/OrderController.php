<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Http\Resources\OrderResource;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['dropoffAddress', 'pickupAddress', 'packageDetails', 'vendor' => function($query){
            $query->with(['bankDetails', 'docDetails', 'address', 'vehicleDetails', 'deviceDetails']);
        }]);
        if(!empty($request['customerName'])) {
            $orders->where('customerName', 'LIKE', '%'.$request['customerName'].'%');
        }
        if(!empty($request['toDate'])) {
            $orders->whereDate('pickupDate', '<=', date('Y-m-d', strtotime($request['toDate'])));
        }
        if(!empty($request['fromDate'])) {
            $orders->whereDate('pickupDate', '>=', date('Y-m-d', strtotime($request['fromDate'])));
        }
        if(!empty($request['month'])) {
            $orders->whereDate('pickupDate', '=', date('Y-m', strtotime($request['month'])));
        }
        if(!empty($request['orderStatus'])) {
            $orders->whereIn('status', $request['orderStatus']);
        }
        return OrderResource::collection($orders->paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $orders = Order::with(['dropoffAddress', 'pickupAddress', 'packageDetails', 'vendor' => function($query){
            $query->with(['bankDetails', 'docDetails', 'address', 'vehicleDetails', 'deviceDetails']);
        }]);
        if(!empty($request['customerName'])) {
            $orders->where('customerName', 'LIKE', '%'.$request['customerName'].'%');
        }
        if(!empty($request['toDate'])) {
            $orders->whereDate('pickupDate', '<=', date('Y-m-d', strtotime($request['toDate'])));
        }
        if(!empty($request['fromDate'])) {
            $orders->whereDate('pickupDate', '>=', date('Y-m-d', strtotime($request['fromDate'])));
        }
        if(!empty($request['month'])) {
            $orders->whereDate('pickupDate', '=', date('Y-m', strtotime($request['month'])));
        }
        if(!empty($request['orderStatus'])) {
            $orders->whereIn('status', $request['orderStatus']);
        }
        return OrderResource::collection($orders->paginate(25));
        
    }

    public function dataImport(Request $request)
    {
        $records = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/../data.json'));
        foreach ($records->data as $record) {
            $order = new Order;
            $order->orderNumber = $record->orderNumber;
            $order->customerName = $record->customerName;
            $order->customerNumber = $record->customerNumber;
            $order->customerPhone = $record->customerPhone;
            $order->pickupDate = date('Y-m-d H:i:s', strtotime($record->pickupDate));
            $order->pickupSlot = $record->pickupSlot;
            $order->packageWeight = $record->packageWeight;
            $order->deliveryCharge = $record->deliveryCharge;
            $order->amountPaid = $record->amountPaid;
            $order->packagePaymentType = $record->packagePaymentType;
            $order->amountToBeCollected = $record->amountToBeCollected;
            $order->pickUpVehicle = $record->pickUpVehicle;
            $order->addInfo = $record->addInfo;
            $order->deliveryType = $record->deliveryType;
            $order->deliveryDate = date('Y-m-d H:i:s', strtotime($record->deliveryDate));
            $order->deliverySlot = $record->deliverySlot;
            $order->paymentType	 = $record->paymentType	;
            $order->status = $record->status;
            $order->deleted = $record->deleted;
            $order->created_at = $record->createdAt;
            $order->updated_at = $record->updatedAt;
            $order->save();
            if(!empty($record->vendor)) {
                $vendor = new \App\Models\OrderVendor(["email" => $record->vendor->email,"password" => $record->vendor->password,"name" => $record->vendor->name,"phone" => $record->vendor->phone,"wallet" => $record->vendor->wallet, "otp" => $record->vendor->otp,"cod_pending" => $record->vendor->cod_pending,"is_admin" => $record->vendor->is_admin,"status" => $record->vendor->status,"deleted" => $record->vendor->deleted,"created_at" => $record->vendor->createdAt,"updated_at" => $record->vendor->updatedAt]);
                $order->vendor()->save($vendor);
                if(!empty($record->vendor->address)) {
                    $vendor_address = new \App\Models\VendorAddress(["locationName" => $record->vendor->address->locationName,"latitude" => $record->vendor->address->latitude,"longitude" => $record->vendor->address->longitude,"buildingNumber" => $record->vendor->address->buildingNumber,"streetNumber" => $record->vendor->address->streetNumber,"municipality" => $record->vendor->address->municipality,"zoneNumber" => $record->vendor->address->zoneNumber,"mapLink" => $record->vendor->address->mapLink]);
                    $order->vendor->address()->save($vendor_address);
                }
                if(!empty($record->vendor->deviceDetails)) {
                    $device_details = new \App\Models\VendorDeviceDetail(["token" => $record->vendor->deviceDetails->token,"type" => $record->vendor->deviceDetails->type]);
                    $order->vendor->deviceDetails()->save($device_details);
                }
                if(!empty($record->vendor->vehicleDetails)) {
                    $vehicle_details = new \App\Models\VendorVehicleDetail(["carPrice" => $record->vendor->vehicleDetails->carPrice,"pickupPrice" => $record->vendor->vehicleDetails->pickupPrice,"twowheelerPrice" => $record->vendor->vehicleDetails->twowheelerPrice]);
                    $order->vendor->vehicleDetails()->save($vehicle_details);
                }
                if(!empty($record->vendor->bankDetails)) {
                    $bank_details = new \App\Models\VendorBankDetail(["accountNumber" => $record->vendor->bankDetails->accountNumber,"ifsc" => $record->vendor->bankDetails->ifsc,"accHolderName" => $record->vendor->bankDetails->accHolderName]);
                    $order->vendor->bankDetails()->save($bank_details);
                }
                $doc_details = new \App\Models\VendorDocDetails(["docName" => '',"filePath" => '',"docType" => '']);
                $order->vendor->docDetails()->save($doc_details);
            }
            if(!empty($record->pickupAddress)) {
                $pickup_address = new \App\Models\OrderPickupAddress(["locationName" => $record->pickupAddress->locationName,"latitude" => $record->pickupAddress->latitude,"longitude" => $record->pickupAddress->longitude,"buildingNumber" => $record->pickupAddress->buildingNumber,"streetNumber" => $record->pickupAddress->streetNumber,"municipality" => $record->pickupAddress->municipality,"zoneNumber" => $record->pickupAddress->zoneNumber,"mapLink" => $record->pickupAddress->mapLink]);
                $order->pickupAddress()->save($pickup_address);
            }
            if(!empty($record->dropoffAddress)) {
                $dropoff_address = new \App\Models\OrderDropoffAddress(["mapLink" => $record->dropoffAddress->mapLink,"latitude" => $record->dropoffAddress->latitude,"longitude" => $record->dropoffAddress->longitude,"zoneNumber" => $record->dropoffAddress->zoneNumber,"locationName" => $record->dropoffAddress->locationName,"streetNumber" => $record->dropoffAddress->streetNumber,"municipality" => $record->dropoffAddress->municipality,"buildingNumber" => $record->dropoffAddress->buildingNumber]);
                $order->dropoffAddress()->save($dropoff_address);
            }

        }
        return "Done";
    }
}
