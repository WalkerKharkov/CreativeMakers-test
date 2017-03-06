<?php
namespace App\Http\Controllers\Agent;

use App\Http\Controllers\AgentController;
use Validator;
use App\Models\Lead;
use App\Models\SphereAttr;
use App\Models\SphereAttrOptions;
use Illuminate\Http\Request;
use Datatables;
use Response;
use DB;

class TestController extends AgentController {

    public function test(){

        $leads = Lead::query()->join( 'open_leads', 'leads.id', '=', 'open_leads.lead_id' )
            ->join( 'customers', 'customers.id', '=', 'leads.customer_id' )
            ->select( 'leads.id', 'leads.date', 'leads.name', 'leads.email', 'customers.phone' )
            ->orderBy( 'leads.id' )
            ->get();
        return view( 'agent.test.test' )->with( 'leads', $leads );

    }

    public function testAjax( Request $request ){

        $id = $request->input( 'id' );
        $result = [];
        $radio = $request->input( 'radio' );
        $checkbox = $request->input( 'checkbox' );
        $sphere_id = Lead::where( 'id', '=', $id )->value( 'sphere_id' );
        $sphere_bitmask_XX = 'sphere_bitmask_' . $sphere_id;

        $result[ 'radio' ] = $this->get_data( $id, $sphere_id, $radio, $sphere_bitmask_XX );
        $result[ 'checkbox' ] = $this->get_data( $id, $sphere_id, $checkbox, $sphere_bitmask_XX );

        return Response::json( $result );

    }

    private function get_data( $id, $sphere_id, $label, $mask){

        $label_id = SphereAttr::where( 'sphere_id', '=', $sphere_id )
            ->where( 'label', '=', $label )
            ->value( 'id' );

        $list = SphereAttrOptions::where( 'sphere_attr_id', '=', $label_id)
            ->where( 'ctype', '=', 'agent' )
            ->get();

        foreach( $list as $item ){
            $field = 'fb_' . $label_id . '_' . $item[ 'id' ];
            $query = DB::table( $mask )->where( $field, '=', 1)
                ->where( 'type', '=', 'lead' )
                ->where( 'user_id', '=', $id)
                ->get();
            if ( ! empty( $query ) ){
                $result = $item[ 'value' ];
            }
        }

        $result = ( isset( $result ) ) ? $result : '';
        return $result;

    }

}