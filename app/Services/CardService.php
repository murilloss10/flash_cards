<?php

namespace App\Services;

use App\Models\Card;
use Illuminate\Http\Request;
use Exception;

class CardService
{
    /**
     * @var Card
     */
    private $card;

    /**
     * @var TestListCardService
     */
    private $testListCardService;

    public function __construct(Card $card, TestListCardService $testListCardService)
    {
        $this->card = $card;
        $this->testListCardService = $testListCardService;
    }

    public function create(Request $request) : array
    {
        try {
            $data = $this->mountArray($request);

            if (!$data)
                throw new Exception('Valores não correspondem.');

            $newCard = $this->card->create($data);

            $this->testListCardService->create($request->test_list_id, $newCard->id);

            $newCard->test_list_card->test_list->updated_at = $newCard->updated_at;
            $newCard->push();

            return [
                'status' => 'success',
                'message' => 'Card criado com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function findAll() : array
    {
        return $this->card->all();
    }

    public function findById(string $id) : Card|null
    {
        return $this->card->find($id);
    }

    public function update(Request $request) : array
    {
        try {
            $cardToBeUpdated = $this->findById($request->card_id);
            if (!$cardToBeUpdated)
                throw new Exception('Card não encontrado.');

            $data = $this->mountArray($request);

            if (!$data)
                throw new Exception('Valores não correspondem.');

            $cardToBeUpdated->update($data);

            $cardToBeUpdated->test_list_card->test_list->updated_at = $cardToBeUpdated->updated_at;
            $cardToBeUpdated->push();

            return [
                'status' => 'success',
                'message' => 'Card atualizado com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function delete(Card $cardToBeDeleted) : array
    {
        try {
            $cardToBeDeleted->delete();

            return [
                'status' => 'success',
                'message' => 'Card deletado com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    private function mountArray(Request $request) : array
    {
        try {
            return [
                'topic'             => $request->topic,
                'question'          => $request->question,
                'question_answer'   => $request->question_answer,
            ];
        } catch (\Exception $e) {
            return [];
        }
    }
}
