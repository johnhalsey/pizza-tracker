<?php

namespace App;

enum PizzaStatus: string
{
    case STARTED = 'started';
    case IN_OVEN = 'in_oven';
    case READY = 'ready';
    case DELIVERED = 'delivered';
}
