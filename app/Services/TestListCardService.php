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

    public function create(string $test_list_id, string $card_id) : string
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

    public function findCards(string $test_list_id)
    {
        $test_list_card = $this->testListCard->where('test_list_id', $test_list_id)->with('card')->get()->toArray();
        $cards  = [];

        foreach ($test_list_card as $key => $value) {
            if ($value['card']) {
                $key++;
                array_push($cards, [
                    $key => $value['card']
                ]);
            }
        }

        shuffle($cards);

        return json_encode($cards);
    }
}
