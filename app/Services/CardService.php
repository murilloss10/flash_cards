<?php

namespace App\Services;

use App\Models\Card;
use Illuminate\Support\Facades\Request;
use UnexpectedValueException;

class CardService
{
    /**
     * @var Card
     */
    private $card;

    public function __construct(Card $card) {
        $this->card = $card;
    }

    public function create(Request $request) : string
    {
        try {
            $data = $this->mountArray($request);

            if (!$data)
                throw new UnexpectedValueException('Valores não correspondem.');

            $this->card->create($data);

            return 'Card criado com sucesso!';
        } catch (\Exception $e) {
            return $e->getMessage();
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

    public function update(Request $request, Card $cardToBeUpdated) : string
    {
        try {
            $data = $this->mountArray($request);

            if (!$data)
                throw new UnexpectedValueException('Valores não correspondem.');

            $cardToBeUpdated->update($data);

            return 'Card atualizado com sucesso!';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(Card $cardToBeDeleted) : string
    {
        try {
            $cardToBeDeleted->delete();

            return 'Card deletado com sucesso!';
        } catch (\Exception $e) {
            return $e->getMessage();
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
