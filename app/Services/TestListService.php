<?php

namespace App\Services;

use App\Models\TestList;
use App\Models\UserTestList;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Exception;

class TestListService
{
    /**
     * @var TestList
     */
    private $testList;

    /**
     * @var UserTestList
     */
    private $userTestList;

    public function __construct(TestList $testList, UserTestList $userTestList) {
        $this->testList     = $testList;
        $this->userTestList = $userTestList;
    }

    public function create(Request $request, $user) : array
    {
        try {
            $data = $this->mountArray($request);

            if (!$data)
                throw new Exception('Valores não correspondem.');

            $newTestList = $this->testList->create($data);

            $this->registerUserTestList((int) $user->id, (string) $newTestList->id);

            return [
                'status' => 'success',
                'message' => 'Lista criada com sucesso!'
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
        return $this->testList->all();
    }

    public function findById(string $id) : TestList|null
    {
        return $this->testList->where('id', $id)->with('test_list_cards.card')->first();
    }

    public function update(Request $request, TestList $testListToBeUpdated) : array
    {
        try {
            $data = $this->mountArray($request);

            if (!$data)
                throw new Exception('Valores não correspondem.');

            $testListToBeUpdated->update($data);

            return [
                'status' => 'success',
                'message' => 'Lista atualizada com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function delete(TestList $testListToBeDeleted) : array
    {
        try {
            $testListToBeDeleted->delete();

            return [
                'status' => 'success',
                'message' => 'Lista deletada com sucesso!'
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
                'name'              => $request->name,
                'color'             => isset($request->color) ? $request->color : null,
                'url_background'    => isset($request->url_background) ? $request->url_background : null,
            ];
        } catch (\Exception $e) {
            return [];
        }
    }

    private function registerUserTestList(int $user_id, string $test_list_id) : bool
    {
        try {
            $this->userTestList->create([
                'user_id'       => $user_id,
                'test_list_id'  => $test_list_id,
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}
