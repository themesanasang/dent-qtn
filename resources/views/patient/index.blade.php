@extends('app')

@section('content')

    <div class="row">
        <ol class="cd-breadcrumb custom-separator">
            <li><a href="{!! url('screen') !!}">หน้าหลัก</a></li>         
            <li class="current"><em>ทะเบียนคนไข้</em></li>
        </ol>
    </div>

    <div class="row">
        <div class="box-under-breadcrumb"><span class="box-red"></span> <span class="text-discharge"> : คนไข้จำหน่าย</span></div>
    </div>

    <div class="row">
        <div class="col s12">
            
            <div id="patientTable_wrapper" class="dataTables_wrapper no-footer"> 
            <table id="patientTable" class="responsive-table striped" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>CID</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>เบอร์โทร</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php $i=0; ?>              
                    @foreach($patient as $key => $value)
                     <?php $i++;  ?>

                        <?php if( ($value->discharge == null) || ($value->discharge == '0000-00-00') ){ ?>
                            <tr data-id="{{ $value->id }}">
                        <?php }else{ ?>
                            <tr class="bg_red_tr" data-id="{{ $value->id }}">
                        <?php } ?>
                        
                            <td>{{ $i }}</td>   
                            <td>{{ $value->cid }}</td>                        
                            <td>{{ $value->fullname }}</td>
                            <td>{{ $value->mobile }}</td>                        
                            <td> 
                                <div class="center-btn">
                                    <a  class="btn-floating waves-effect waves-light blue tooltipped" data-position="top" data-delay="50" data-tooltip="การรักษา" href="{{ url('patient/treatment') }}/{{ Crypt::encrypt($value->id) }}" >
                                        <i class="mdi-action-list icon-color-green"></i>
                                    </a>
                                    <a class="btn-floating waves-effect waves-light yellow tooltipped" data-position="top" data-delay="50" data-tooltip="รายการคัดกรอง" href="{{ url('patient/listscreen') }}/{{ Crypt::encrypt($value->cid) }}/{{ Crypt::encrypt($value->id) }}" >
                                        <i class="mdi-action-list icon-color-blue"></i>
                                    </a>
                                    <a class="btn-floating waves-effect waves-light green tooltipped" data-position="top" data-delay="50" data-tooltip="แก้ไข" href="{{ route( 'patient.edit', Crypt::encrypt($value->id) ) }}">
                                        <i class="mdi-editor-mode-edit icon-color-qray"></i>
                                    </a>
                                    <a class="btn-floating waves-effect waves-light red btn-patient-delete tooltipped" data-position="top" data-delay="50" data-tooltip="ลบ" href="{{ route( 'patient.destroy', Crypt::encrypt($value->id) ) }}" data-method="delete" data-confirm="ต้องการลบผู้ใช้ {{ e($value->fullname) }}" data-remote="true" rel="nofollow">
                                        <i class="mdi-action-delete icon-color-red"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>           
                    @endforeach
                    
                </tbody>
            </table>
            </div>
            
        </div>
    </div>
    

@endsection
