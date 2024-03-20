<?php

namespace App\Services;

use App\Models\TestListCard;

class TestListCardService
{
    /**
     * @var TestListCard
     */
    private $testListCard;

    public function __construct(TestListCard $testListCard) {
        $this->testListCard = $testListCard;
    }

    public function create(int $test_list_id, int $card_id) : string
    {
        try {
            $this->testListCard->create([
                'test_list_id'  => $test_list_id,
                'card_id'       => $card_id
            ]);

            return 'Card adicionado na lista!';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
