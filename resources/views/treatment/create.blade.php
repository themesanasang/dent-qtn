@extends('app')

@section('content')

    <div class="row">      
        <ol class="cd-breadcrumb custom-separator">
            <li><a href="{!! url('screen') !!}">หน้าหลัก</a></li> 
            <li><a href="{!! url('patient') !!}">ทะเบียนคนไข้</a></li> 
            <li class="current"><em>เพิ่มการรักษา</em></li>
        </ol>
    </div>

    <div class="row">
     
            <div class="header center">
                เพิ่มการรักษา
            </div>
                        
            <div class="form-regis">
            {!! Form::open( array('route' => 'treatment.store', 'class' => 'col s12 offset-s3') ) !!}	  

              <input type="hidden" name="patient_id" value="{{ $patient_id }}" />
                
              <div class="row">
                <div class="input-field col s6">    
                  <label for="vstdate">วันที่รับบริการ(ว-ด-ป)</label>    
                  <input id="vstdate" name="vstdate" type="text" class="datepicker_vstdate picker__input" readonly="" tabindex="-1" aria-haspopup="true" aria-expanded="false" aria-readonly="false" value="<?php echo date("d-m-Y"); ?>" />    
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <textarea id="finding" class="materialize-textarea" name="finding"></textarea>
                  <label for="finding">Finding</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <textarea id="treatment" class="materialize-textarea" name="treatment"></textarea>
                  <label for="treatment">Treatment</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <textarea id="remark" class="materialize-textarea" name="remark"></textarea>
                  <label for="remark">Remark</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">    
                  <label for="nextdate">วันที่นัด(ว-ด-ป)</label>    
                  <input id="nextdate" name="nextdate" type="text" class="datepicker_nextdate picker__input" readonly="" tabindex="-1" aria-haspopup="true" aria-expanded="false" aria-readonly="false"  />    
                </div>
              </div>
              <div class="row">
                  <div class="input-field col s6">
                    <input id="nexttime" name="nexttime" type="text">                      
                    <label for="nexttime"> เวลาที่นัด(ชั่วโมง:นาที:วินาที)</label>                          
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
