<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DataExport implements FromCollection, WithHeadings, WithMapping, Responsable
{
    use Exportable;

    private $data;
    private $auth;

    public function __construct($data, $auth)
    {
        $this->data = $data;
        $this->auth = $auth;
    }

    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function headings(): array
    {
        return [
            '#',
            'Наименование',
            'ПАРАМЕТР 1',
            'ПАРАМЕТР 2',
            'ПАРАМЕТР 3',
        ];
    }

    /**
     * @param $data
     * @return array
     */
    public function map($data): array
    {
        return [
            $data['id'],
            $data['name'],
            $data['param1'],
            $this->auth ? $data['param2'] : '***',
            $this->auth ? $data['param3'] : '***',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = new Collection($this->data);

        $data->push([
            'id' => '',
            'name' => 'Итого',
            'param1' => $data->sum('param1'),
            'param2' => $data->sum('param2'),
            'param3' => $data->sum('param3'),
        ]);
        return $data;
    }
}
