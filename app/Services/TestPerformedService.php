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

    public function create(Request $request, User $user, TestList $test_list) : string
    {
        try {
            $data = $this->mountArray($request, $user, $test_list);

            if (!$data)
                throw new UnexpectedValueException('Valores não correspondem.');

            $this->testPerformed->create($data);

            return 'Teste concluído!';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function mountArray(Request $request, User $user, TestList $test_list) : array
    {
        try {
            return [
                'user_id'           => $user->id,
                'test_list_id'      => $test_list->id,
                'corrects'          => $request->corrects,
                'incorrects'        => $request->incorrects,
                'total_questions'   => $request->total_questions,
            ];
        } catch (\Exception $e) {
            return [];
        }
    }
}
