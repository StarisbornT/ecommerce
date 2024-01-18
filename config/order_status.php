<?php

return [
    'order_status_admin' => [
        'pending' => [
            'status' => 'pending',
            'details' => 'Your order is currently pending'
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Processed and ready to ship',
            'details' => 'Your Package has been processed and will be with our delivery team'
        ],
        'dropped_off' => [
            'status' => 'Dropped Off',
            'details' => 'Your package has been dropped off by the seller'
        ],
        'shipped' => [
            'status' => 'Shipped',
            'details' => 'Your Package has arrived at our logistics facility'
        ],
        'out_for_delivery' => [
            'status' => 'Out for Delivery',
            'details' => 'Our delivery partner will attempt to delivery your package'
        ],
        'delivered' => [
            'status' => 'Delivered',
            'details' => 'Delivered'
        ],
        'cancelled' => [
            'status' => 'Cancelled',
            'details' => 'Cancelled'
        ]
        ],

    'order_status_vendor' => [
        'pending' => [
            'status' => 'pending',
            'details' => 'Your order is currently pending'
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Processed and ready to ship',
            'details' => 'Your Package has been processed and will be with our delivery team'
        ]
        // 'dropped_off' => [
        //     'status' => 'Dropped Off',
        //     'details' => 'Your package has been dropped off by the seller'
        // ],
        // 'shipped' => [
        //     'status' => 'Shipped',
        //     'details' => 'Your Package has arrived at our logistics facility'
        // ],
        // 'out_for_delivery' => [
        //     'status' => 'Out for Delivery',
        //     'details' => 'Our delivery partner will attempt to delivery your package'
        // ],
        // 'delivered' => [
        //     'status' => 'Delivered',
        //     'details' => 'Delivered'
        // ]
    ]
];
