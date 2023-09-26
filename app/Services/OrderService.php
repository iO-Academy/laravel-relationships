<?php

namespace App\Services;

class OrderService
{
    public function calculateValueOfOrders($orders): float
    {
        $total = 0;

        // Loop through the array of order models
        foreach($orders as $order) {
            // Then for each of the order models, loop through it's array of Product models
            foreach($order->products as $product) {
                // Now we have access to each product in each order, so we can access the prices
                // to calculate a running total
                $total += $product->price;
            }
        }
        // Finished looping through the orders, now we can return the total
        return $total;
    }
}