@extends('app')

@section('content')

    <div class="row">
        <ol class="cd-breadcrumb custom-separator">
            <li><a href="{!! url('screen') !!}">หน้าหลัก</a></li>         
            <li class="current"><em>รายงาน</em></li>
        </ol>
    </div>

    <div class="row">
        <div class="col s12">
            
            <ul class="collection with-header">
                <li class="collection-header"><h4>รายงาน</h4></li>
                <li class="collection-item"><div>รายงาน PMD<a href="{!! url('report/pmd') !!}" class="secondary-content"><i class="mdi-content-send right"></i></a></div></li>
            </ul>
            
        </div>
    </div>
    

@endsection
