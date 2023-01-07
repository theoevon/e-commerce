<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class PaimentController extends AbstractController{
  
  public function getProducts(){
    
    $jsonStr = file_get_contents('php://input');
    $jsonObj = json_decode($jsonStr);
    $tableau = [];
    foreach ($jsonObj as $key => $value) {
      array_push($tableau, [
        'price_data' => [
          'currency' => 'eur',
          'product_data' => ['name' => $value->name, 'description' => $value->description],
          'unit_amount' => $value->variant[0]->price*100,
        ],
        'quantity' => 1,] );
    }
    return $tableau;
  }
  public function getFreeShippingFeez(){
    
    $jsonStr = file_get_contents('php://input');
    $jsonObj = json_decode($jsonStr);
    foreach ($jsonObj as $key => $value) {

       $feez = ($value->variant[0]->weight * 0.8)*10;


    return round($feez);
  }
}
public function getShippingFeez(){
    
  $jsonStr = file_get_contents('php://input');
  $jsonObj = json_decode($jsonStr);
  foreach ($jsonObj as $key => $value) {

     $feez = ((7+$value->variant[0]->weight)* 0.8)*18;

  return round($feez);
 
}
}


 #[Route('/paiement', name: 'app_paiement')]
  public function paiment(Request $request): Response{
  $stripe =  new \Stripe\StripeClient('sk_test_51MMU68LjlqtzfHvan6obl4BUxY6qESoCb9f55yGlh8pyOlqV68komzdHvGw0kiI2LGvto5ANP6XlXImYw6cJlSdP00HGBapFpV');    
   
   $session = $stripe->checkout->sessions->create(
    [
      'payment_method_types' => ['card'],
      'shipping_address_collection' => ['allowed_countries' => ['FR']],
      'shipping_options' => [
        ['shipping_rate_data' => [
          'type' => 'fixed_amount',
          'fixed_amount' => ['amount' => self::getShippingFeez(), 'currency' => 'eur'],
          'display_name' => 'Livraison express',
          'delivery_estimate' => [
            'minimum' => ['unit' => 'business_day', 'value' => 3],
            'maximum' => ['unit' => 'business_day', 'value' => 4],
          ],
        ],
      ],
   ['shipping_rate_data' => [
          'type' => 'fixed_amount',
          'fixed_amount' => ['amount' => self::getFreeShippingFeez(), 'currency' => 'eur'],
          'display_name' => 'Livraison standard',
          'delivery_estimate' => [
            'minimum' => ['unit' => 'business_day', 'value' => 10],
            'maximum' => ['unit' => 'business_day', 'value' => 15],
          ],
        ],
      ],

      ],
      'line_items' => [
       self::getProducts()
      ],
      'mode' => 'payment',
      'success_url' => 'https://example.com/success',
      'cancel_url' => 'https://example.com/cancel',
    ]) ;
   return new Response($session->url);
  } 
}
