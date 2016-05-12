@extends('app')

@section('content')

    <div class="row">
        <ol class="cd-breadcrumb custom-separator">
            <li><a href="{!! url('screen') !!}">หน้าหลัก</a></li>         
            <li><a href="{!! url('report') !!}">รายงาน</a></li>
            <li class="current"><em>รายงาน PMD</em></li>
        </ol>
    </div>

    <div class="row">
        <div class="col s12">
            
          <div class="row">
            <form class="col s12" action="export_pmd" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
              <div class="row">
                <div class="input-field col s6">
                  <label for="date_start_pmd">เริ่มวันที่(ว-ด-ป)</label>  
                  <input id="date_start_pmd" name="date_start_pmd" type="text" class="datepicker picker__input" readonly="" tabindex="-1" aria-haspopup="true" aria-expanded="false" aria-readonly="false" value="<?php echo date("d-m-Y"); ?>" /> 
                </div>
                <div class="input-field col s6">
                  <label for="date_end_pmd">ถึงวันที่(ว-ด-ป)</label>  
                  <input id="date_end_pmd" name="date_end_pmd" type="text" class="datepicker picker__input" readonly="" tabindex="-1" aria-haspopup="true" aria-expanded="false" aria-readonly="false" value="<?php echo date("d-m-Y"); ?>" /> 
                </div>
              </div>
               <div class="row">
                <div class="col s12 center">
                      <button class="btn waves-effect waves-light" type="submit">
                          ตกลง
                        <i class="mdi-content-send right"></i>
                      </button>
                </div>
                </div>
              
            </form>
          </div>
            
        </div>
    </div>
    

@endsection
