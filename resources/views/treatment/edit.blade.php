@extends('app')

@section('content')

    <div class="row">      
        <ol class="cd-breadcrumb custom-separator">
            <li><a href="{!! url('screen') !!}">หน้าหลัก</a></li> 
            <li><a href="{!! url('patient') !!}">ทะเบียนคนไข้</a></li> 
            <li class="current"><em>แก้ไขการรักษา</em></li>
        </ol>
    </div>

    <div class="row">
     
            <div class="header center">
                แก้ไขการรักษา
            </div>
                        
            <div class="form-regis">
            {!! Form::open( array('route' => ['treatment.update', e($treatment->id)], 'class' => 'col s12 offset-s3', 'method' => 'PATCH') ) !!}   
                
              <div class="row">
                <div class="input-field col s6">    
                  <label for="e-vstdate">วันที่รับบริการ(ว-ด-ป)</label>    
                  <input id="e-vstdate" name="vstdate" type="text" class="datepicker_vstdate picker__input" readonly="" tabindex="-1" aria-haspopup="true" aria-expanded="false" aria-readonly="false" value="<?php echo date("d-m-Y", strtotime($treatment->vstdate)); ?>" />    
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <textarea id="e-finding" class="materialize-textarea" name="finding">{{ $treatment->finding }}</textarea>
                  <label for="e-finding">Finding</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <textarea id="e-treatment" class="materialize-textarea" name="treatment">{{ $treatment->treatment }}</textarea>
                  <label for="e-treatment">Treatment</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <textarea id="e-remark" class="materialize-textarea" name="remark">{{ $treatment->remark }}</textarea>
                  <label for="e-remark">Remark</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">    
                  <label for="e-nextdate">วันที่นัด(ว-ด-ป)</label>    
                  <input id="e-nextdate" name="nextdate" type="text" class="datepicker_nextdate picker__input" readonly="" tabindex="-1" aria-haspopup="true" aria-expanded="false" aria-readonly="false" value="<?php echo (($treatment->nextdate == '0000-00-00')?'':date("d-m-Y", strtotime($treatment->nextdate))); ?>"  />    
                </div>
              </div>
              <div class="row">
                  <div class="input-field col s6">
                    <input id="e-nexttime" name="nexttime" type="text">                      
                    <label for="e-nexttime"> เวลาที่นัด(ชั่วโมง:นาที:วินาที)</label>                          
                  </div>                                                         
              </div>
          
              
             <br>    
             <div class="row"> 
                <div class=" col s6 center">
                    <button class="btn waves-effect waves-light" type="submit" name="action">บันทึก</button>
                    <a href="{!! url('patient') !!}" class="waves-effect waves-light btn grey">ยกเลิก</a>
                </div>
             </div>
                
            {!! Form::close() !!}<!-- form -->
            </div><!-- .form-regis  -->
            
        
        
    </div>

    

@endsection
