<?php

namespace App\Http\Controllers;

use App\Exceptions\ImportException;
use App\Imports\UsersImport;
use App\User;
use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{

    public function showImport()
    {
        $users = User::all();

        $users = $users->groupBy('country');
        $lava = new Lavacharts();

        $popularity = $lava->DataTable();

        $popularity->addStringColumn('Country')
            ->addNumberColumn('Popularity');

        foreach ($users as $key => $country) {
            $popularity->addRow([$key, $users["$key"]->count()]);
        }

        $lava->GeoChart('Popularity', $popularity);

        return view('user.import', ['lava' => $lava]);
    }

    public function import(Request $request)
    {
        if ($request->file('import_file')) {
            ini_set('max_execution_time', 0);

            try {
                Excel::import(new UsersImport, $request->file('import_file'));
            } catch (ImportException $exception) {
                return redirect('import')->with(
                    'exception',
                    $exception->getMessage() . '. File must has fields : first_name, last_name, email, country, gender'
                );
            }
            return redirect('import')->with('success', 'All good!');
        } else {
            return redirect('import');
        }

    }
}