<?php

namespace App\Services;

use App\Models\TestList;
use Illuminate\Support\Facades\Request;
use UnexpectedValueException;

class TestListService
{
    /**
     * @var TestList
     */
    private $testList;

    public function __construct(TestList $testList) {
        $this->testList = $testList;
    }

    public function create(Request $request) : string
    {
        try {
            $data = $this->mountArray($request);

            if (!$data)
                throw new UnexpectedValueException('Valores não correspondem.');

            $this->testList->create($data);

            return 'Lista criada com sucesso!';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function findAll() : array
    {
        return $this->testList->all();
    }

    public function findById(string $id) : TestList|null
    {
        return $this->testList->find($id);
    }

    public function update(Request $request, TestList $testListToBeUpdated) : string
    {
        try {
            $data = $this->mountArray($request);

            if (!$data)
                throw new UnexpectedValueException('Valores não correspondem.');

            $testListToBeUpdated->update($data);

            return 'Lista atualizada com sucesso!';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(TestList $testListToBeDeleted) : string
    {
        try {
            $testListToBeDeleted->delete();

            return 'Lista deletada com sucesso!';
        } catch (\Exception $e) {
            return $e->getMessage();
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

}
