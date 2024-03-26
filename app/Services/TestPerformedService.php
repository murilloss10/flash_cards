<?php

namespace App\Services;

use App\Models\TestList;
use App\Models\TestPerformed;
use App\Models\User;
use Illuminate\Http\Request;
use UnexpectedValueException;

class TestPerformedService
{
    /**
     * @var TestPerformed
     */
    private $testPerformed;

    public function __construct(TestPerformed $testPerformed) {
        $this->testPerformed = $testPerformed;
    }

    public function create(Request $request, User $user) : array
    {
        try {
            $data = $this->mountArray($request, $user);

            if (!$data)
                throw new UnexpectedValueException('Valores não correspondem.');

            $testPerformed = $this->testPerformed->create($data);

            return [
                'status'    => 'success',
                'message'   => 'Teste concluído! Você acertou ' . $testPerformed->corrects . ' de ' . $testPerformed->total_questions . ' questões.'
            ];
        } catch (\Exception $e) {
            return [
                'status'    => 'success',
                'message'   => $e->getMessage()
            ];
        }
    }

    public function mountArray(Request $request, User $user) : array
    {
        try {
            return [
                'user_id'           => $user->id,
                'test_list_id'      => $request->test_list_id,
                'corrects'          => $request->corrects ? $request->corrects : 0,
                'incorrects'        => $request->incorrects ? $request->incorrects : 0,
                'total_questions'   => $request->total_questions,
            ];
        } catch (\Exception $e) {
            return [];
        }
    }
}
