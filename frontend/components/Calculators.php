<?php
namespace frontend\components;
use yii\base\BaseObject;

use frontend\models\Accounts;
use frontend\models\Bookings;
use frontend\models\Leads;
use frontend\models\Payments;
use frontend\models\Unittypes;
use frontend\models\Units;
use frontend\models\Packages;
use frontend\models\Extras;
use frontend\models\Eventtypes;

//use frontend\models\PaymentParts;

class Calculators extends BaseObject 
{  
    public static function curlcall($url, $params)
    {     
        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        //$result = json_decode(curl_exec($ch));
        if(curl_errno($ch) || !$result){echo 'Error:' . curl_error($ch); curl_close ($ch);}else{ curl_close ($ch); return $result; }      
    }
    
    //Hubstaff users api//
   	public static function getalldata($url, $params, $param_id)
	{       
        ini_set('max_execution_time', 1500000);
        ini_set("memory_limit","520M"); 
                
        Self::getAccounts($url.'/api/v1/get/account', $params, $param_id);
        Self::getBookings($url.'/api/v1/get/bookings', $params, $param_id);
        Self::getLeads($url.'/api/v1/get/leads', $params, $param_id);
        Self::getPayments($url.'/api/v1/get/payments', $params, $param_id);
        Self::getUnittypes($url.'/api/v1/get/unit_types', $params, $param_id);
        Self::getUnits($url.'/api/v1/get/units', $params, $param_id);
        Self::getPackages($url.'/api/v1/get/packages', $params, $param_id);
        Self::getExtras($url.'/api/v1/get/extras', $params, $param_id);
        Self::getEventtypes($url.'/api/v1/get/event_types', $params, $param_id);
        
        return 'OK';
	}
    
    public static function getAccounts($url, $params, $param_id)
	{             
        $res = json_decode(Self::curlcall($url, $params)); 
        if($res){     
            //foreach($result as $res){
                
            $model = Accounts::find()->where(['business_name'=>$res->business_name, 'business_website'=>$res->business_website, 'business_address' => $res->business_address])->all();
    		if(count($model)==0){
			    $new_model = new Accounts;
                $new_model->param_id = $param_id;
                $new_model->result = $res->result;
                $new_model->business_name = $res->business_name;
                $new_model->business_website = $res->business_website;
                $new_model->business_timezone = $res->business_timezone;
                $new_model->business_address = $res->business_address;
                $new_model->business_postcode = $res->business_postcode;
                $new_model->business_country = $res->business_country;
                $new_model->business_admin = $res->business_admin;
                $new_model->currency_code = $res->currency_code;
                $new_model->currency_sign = $res->currency_sign;
                $new_model->affiliate = $res->affiliate;
                $new_model->is_paid = "$res->is_paid";
                $new_model->plan = $res->plan;       
                $new_model->save(); 
                }
           // }               
        };        
	}
    
    public static function getBookings($url, $params, $param_id)
	{             
        $result = json_decode(Self::curlcall($url, $params)); 
        if($result){     
            foreach($result->bookings as $res){
            $model = Bookings::find()->where(['param_id'=> $param_id, 'id'=>$res->id])->all();   
    		if(count($model)==0){
			    $new_model = new Bookings;
                $new_model->param_id = $param_id;
                $new_model->id = $res->id;
                $new_model->created = "$res->created";
                $new_model->created_iso = "$res->created_iso";
                $new_model->changed = "$res->changed";
                $new_model->changed_iso = "$res->changed_iso";
                $new_model->status = "$res->status";
                $new_model->email = "$res->email";
                $new_model->phone = "$res->phone";
                $new_model->customer = json_encode($res->customer);
                $new_model->staff = json_encode($res->staff);
                $new_model->rep = json_encode($res->rep);
                $new_model->vehicle = json_encode($res->vehicle);
                $new_model->assets = json_encode($res->assets);
                $new_model->packages = "$res->packages";
                $new_model->extras = "$res->extras";
                $new_model->event_name = "$res->event_name";
                $new_model->event = json_encode($res->event);
                $new_model->venue = json_encode($res->venue);
                $new_model->price = json_encode($res->price);
                $new_model->notes = json_encode($res->notes);
                $new_model->signature_required = "$res->signature_required";
                $new_model->signature = "$res->signature";
                $new_model->travel = json_encode($res->travel);
                $new_model->template = json_encode($res->template);
                $new_model->taxjar = json_encode($res->taxjar);
                $new_model->ein = json_encode($res->ein);
                $new_model->tax_rate = "$res->tax_rate";
                
                $new_model->save(); 
     //                           var_dump($new_model->getErrors());
//  exit;
                }
            }               
        };        
	}
    
    public static function getLeads($url, $params, $param_id)
	{             
        $result = json_decode(Self::curlcall($url, $params)); 
        if( $result){     
            foreach($result->leads as $res){
            $model = Leads::find()->where(['param_id'=>$param_id, 'id'=>$res->id])->all();
    		if(count($model)==0){
			    $new_model = new Leads;
                $new_model->param_id = $param_id;
                $new_model->id = $res->id;
                $new_model->created = $res->created;
                $new_model->created_iso = $res->created_iso;
                $new_model->changed = $res->changed;
                $new_model->changed_iso = $res->changed_iso;
                $new_model->customer = json_encode($res->customer);
                $new_model->status = $res->status;
                $new_model->activity = json_encode($res->activity);
                $new_model->event = json_encode($res->event);
                $new_model->converted_bookings = json_encode($res->converted_bookings);
       
                $new_model->save(); 
                }
            }               
        };        
	}
    
    public static function getPayments($url, $params, $param_id)
	{             
        $result = json_decode(Self::curlcall($url, $params)); 
        if($result){     
            foreach($result as $res){
            $model = Payments::find()->where(['param_id'=>$param_id, 'id'=>$res->id])->all();
    		if(count($model)==0){
			    $new_model = new Payments;
                $new_model->param_id = $param_id;
                $new_model->id = $res->id;
                $new_model->transaction_id = $res->transaction_id;
                $new_model->label = $res->label;
                $new_model->parts = json_encode($res->parts);
                $new_model->created = $res->created;
                $new_model->created_iso = $res->created_iso;
                $new_model->original_amount = $res->original_amount;
                $new_model->refunded_amount = $res->refunded_amount;
                $new_model->amount = $res->amount;
                $new_model->gratuity = $res->gratuity;
                $new_model->booking_id = $res->booking_id;
                $new_model->source = $res->source;
                $new_model->submitter = $res->submitter;       
                $new_model->save(); 
                
               // Self::savePaymentParts($res->parts, $new_model->payment_id);
                
                }
            }               
        };        
	}
    
    public static function savePaymentParts($parts, $payment_id){
        if(isset($parts->subtotal)){
            $part = $parts->subtotal;
            $model = PaymentParts::find()->where(['line_nid'=>$part->line_nid])->all();
    		if(count($model)==0){
            
            
            //foreach($parts->subtotal as $part){
                $new_model = new PaymentParts;
                $new_model->payment_id = $payment_id; 
                $new_model->part_type = "subtotal";
                $new_model->label = $part->label; 
                $new_model->original_amount = $part->original_amount; 
                $new_model->refunded_amount = $part->refunded_amount; 
                $new_model->amount = $part->refunded_amount; 
                $new_model->line_nid = $part->line_nid; 
                $new_model->save(); 
//var_dump($new_model->getErrors());
//exit;
            //}
            }
        }
        if(isset($parts->tax)){
            $part = $parts->tax;
            $model = PaymentParts::find()->where(['line_nid'=>$part->line_nid])->all();
    		if(count($model)==0){
            //foreach($parts->tax as $part){
      
                $new_model = new PaymentParts;
                $new_model->payment_id = $payment_id; 
                $new_model->part_type = "tax"; 
                $new_model->label = $part->label; 
                $new_model->original_amount = $part->original_amount; 
                $new_model->refunded_amount = $part->refunded_amount; 
                $new_model->amount = $part->refunded_amount; 
                $new_model->line_nid = $part->line_nid; 
                $new_model->save(); 
//var_dump($new_model->getErrors());
//exit;
            //}
            }
        }
    }
    
    
    public static function getUnittypes($url, $params, $param_id)
	{             
        $result = json_decode(Self::curlcall($url, $params)); 
        if($result){     
            foreach($result as $res){
            $model = Unittypes::find()->where(['id'=>$res->id])->all();
    		if(count($model)==0){
			    $new_model = new Unittypes;
                $new_model->id = $res->id;
                $new_model->param_id = $param_id;
                $new_model->label = $res->label;  
                $new_model->save(); 
                }
            }               
        };        
	}

    public static function getUnits($url, $params, $param_id)
	{             
        $result = json_decode(Self::curlcall($url, $params)); 
        if($result){     
            foreach($result as $res){
            $model = Units::find()->where(['id'=>$res->id])->all();
    		if(count($model)==0){
			    $new_model = new Units;
                $new_model->id = $res->id;
                $new_model->param_id = $param_id;
                $new_model->label = $res->label;  
                $new_model->save(); 
                }
            }               
        };        
	}

    public static function getEventtypes($url, $params, $param_id)
	{             
        $result = json_decode(Self::curlcall($url, $params)); 
        if($result){     
            foreach($result as $res){
            $model = Eventtypes::find()->where(['id'=>$res->id])->all();
    		if(count($model)==0){
			    $new_model = new Eventtypes;
                $new_model->id = $res->id;
                $new_model->param_id = $param_id;
                $new_model->label = $res->label;  
                $new_model->save(); 
                }
            }               
        };        
	}
        
    public static function getPackages($url, $params, $param_id)
	{             
        $result = json_decode(Self::curlcall($url, $params)); 
        if($result){     
            foreach($result as $res){
            $model = Packages::find()->where(['param_id'=>$param_id, 'id'=>$res->id])->all();
    		if(count($model)==0){
			    $new_model = new Packages;
                $new_model->param_id = $param_id;
                $new_model->id = $res->id;
                $new_model->label = $res->label;
                $new_model->price = $res->price;
                $new_model->description = $res->description;
                $new_model->unit_type = $res->unit_type;
                $new_model->time_slot = $res->time_slot;
                $new_model->included_extras = json_encode($res->included_extras);
                $new_model->disabled = "$res->disabled";
                $new_model->custom = "$res->custom";     
                $new_model->save();
                }
            }               
        };        
	}
    
    public static function getExtras($url, $params, $param_id)
	{             
        $result = json_decode(Self::curlcall($url, $params)); 
        if($result){     
            foreach($result as $res){
            $model = Extras::find()->where(['param_id'=>$param_id, 'id'=>$res->id])->all();
    		if(count($model)==0){
			    $new_model = new Extras;
                $new_model->param_id = $param_id;
                $new_model->id = $res->id;
                $new_model->label = $res->label;
                $new_model->price = $res->price;
                $new_model->description = $res->description;
                $new_model->upsell_price = $res->upsell_price;
                $new_model->upsell_description = $res->upsell_description;
                $new_model->image = $res->image;
                $new_model->quantity = $res->quantity;
                $new_model->stock = $res->stock;
                $new_model->unit_types = json_encode($res->unit_types);
                $new_model->extras_group = $res->extras_group;
                $new_model->disabled = "$res->disabled";
                $new_model->custom = "$res->custom";     
                $new_model->save();
 //var_dump($new_model->getErrors());
 // exit;  
                }
            }               
        };        
	}    
}