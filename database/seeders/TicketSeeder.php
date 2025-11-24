<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::query()->create(
            ['customer_id' => '1',
             'subject' => 'Новая заявка',
             'text' => 'Добрый день! Сколько будет стоить новое платье?',
             'is_incoming' => true,
             'status' => 'new',
            ]
        );
        Ticket::query()->create(
            ['customer_id' => '1',
             'subject' => 'Новая заявка',
             'text' => 'Добрый день! Новое платье будет стоить $500',
             'is_incoming' => false,
             'status' => 'new',
            ]
        );
        Ticket::query()->create(
            ['customer_id' => '1',
             'subject' => 'Новая заявка',
             'text' => 'Хорошо, скиньте реквизиты для оплаты.',
             'is_incoming' => true,
             'status' => 'new',
            ]
        );
        Ticket::query()->create(
            ['customer_id' => '1',
             'subject' => 'Новая заявка',
             'text' => 'Можете сделать оплату на карту.
                        Номер карты: 1234 5678 9012 3456',
             'is_incoming' => false,
             'status' => 'new',
            ]
        );
        Ticket::query()->create(
            ['customer_id' => '1',
             'subject' => 'Новая заявка',
             'text' => 'Оплата прошла успешно. Посмотрите, пожалуйста',
             'is_incoming' => true,
             'status' => 'new',
            ]
        );
        Ticket::query()->create(
            ['customer_id' => '1',
             'subject' => 'Новая заявка',
             'text' => 'Да, оплата прошла. Ожидайте доставку платья по адресу, который указан в личном кабинете. Спасибо за покупку!',
             'is_incoming' => false,
             'status' => 'new',
            ]
        );
    }
}
