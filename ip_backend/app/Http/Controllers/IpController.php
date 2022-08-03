<?php

namespace App\Http\Controllers;

use App\Models\Ip;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\IpCollection;


class IpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ips = Ip::paginate(15);

        return new IpCollection($ips);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated =  request()->validate([
            'ip' => 'required | ip | unique:ips,ip',
            'label' => 'required | unique:ips,label',
        ]);

        $ip =  Ip::create($validated);

        $logs = $ip->log()->create([
            'new_data' => json_encode($ip),
            'prev_data' => '',
            'type' => 2,
            'user_id' => Auth::id(),
        ]); 

        return ['ip' => $ip, 'success' => true,
                'message' => 'Sucessfully added an IP'
               ];
    }

    public function update(Request $request, Ip $ip)
    {
        $new_data = $ip;
        $prev_data = $ip->getOriginal();

        $validated =  request()->validate([
            'label' => "required | unique:ips,label,$ip->id",
        ]);

        $updated = $ip->update($validated);

        $logs = $ip->log()->create([
            'new_data' => json_encode($new_data),
            'prev_data' => json_encode($prev_data),
            'type' => 3,
            'user_id' => Auth::id(),
        ]); 

        if($updated){
            return [
                'success' => true,
                'message' => 'Sucessfully updated an IP label'
            ];
        }
        return [
            'success' => false,
            'message' => 'Updating IP label failed'
        ];;
    }

    public function destroy(Ip $ip)
    {
        //
    }
}
