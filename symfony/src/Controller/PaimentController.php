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

 #[Route('/paiement', name: 'app_paiement')]
  public function paiment(Request $request): Response{
  $stripe =  new \Stripe\StripeClient('sk_test_51MMU68LjlqtzfHvan6obl4BUxY6qESoCb9f55yGlh8pyOlqV68komzdHvGw0kiI2LGvto5ANP6XlXImYw6cJlSdP00HGBapFpV');    
   self::getProducts();
   $session = $stripe->checkout->sessions->create(
    [
      'payment_method_types' => ['card'],
      'shipping_address_collection' => ['allowed_countries' => ['FR']],
      'shipping_options' => [
        [
          'shipping_rate_data' => [
            'type' => 'fixed_amount',
            'fixed_amount' => ['amount' => 0, 'currency' => 'eur'],
            'display_name' => 'Free shipping',
            'delivery_estimate' => [
              'minimum' => ['unit' => 'business_day', 'value' => 5],
              'maximum' => ['unit' => 'business_day', 'value' => 7],
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
