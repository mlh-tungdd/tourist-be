<?php

namespace App\Listeners;

use App\Events\AddOrderEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\DealServiceInterface;

class AddDealOfOrderListener
{
    protected $dealService;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DealServiceInterface $dealService)
    {
        $this->dealService = $dealService;
    }

    /**
     * Handle the event.
     *
     * @param  AddOrderEvent  $event
     * @return void
     */
    public function handle(AddOrderEvent $event)
    {
        $this->dealService->addNewDeal([
            'id_user' => $event->deal['id_user'],
            'description' => $event->deal['description'],
            'money' => $event->deal['money'],
            'type' => $event->deal['type'],
            'created_by' => $event->deal['created_by'],
            'updated_by' => $event->deal['updated_by'],
        ]);
    }
}
