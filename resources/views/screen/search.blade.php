@extends('app')

@section('content')

    <div class="row">
        <ol class="cd-breadcrumb custom-separator">
            <li><a href="{!! url('screen') !!}">หน้าหลัก</a></li>         
            <li class="current"><em>รายการค้นหา</em></li>
        </ol>
    </div>

    <div class="row">
        <div class="col s12">
            
            <div id="userTable_wrapper" class="dataTables_wrapper no-footer"> 
            <table id="searchTable" class="responsive-table striped" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>CID</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>วันที่คัดกรอง</th>
                    <th>คัดกรองโดย</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                
                <?php $i=0; ?> 
                @foreach ($result as $value)
                <?php $i++;  ?>
                    <tr data-id="{{ $value->id }}">
                            <td>{{ $i }}</td>   
                            <td>{{ $value->cid }}</td>                        
                            <td>{{ $value->fullname }}</td>
                            <td>{{ date("d", strtotime($value->regdate)).'-'.date("m", strtotime($value->regdate)).'-'.(date("Y", strtotime($value->regdate))+543)  }}</td>
                            <td>{{ $value->create_by }}</td>
                            <td>                           	 
                                <a title="แก้ไข" class="" href="{{ route( 'screen.edit', e($value->id) ) }}">
                                    <i class="mdi-editor-mode-edit icon-color-qray"></i>
                                </a>
                                <a title="ลบ" class="btn-screen-delete" href="{{ route( 'screen.destroy', e($value->id) ) }}" data-method="delete" data-confirm="ต้องการลบผู้ใช้ {{ e($value->fullname) }}" data-remote="true" rel="nofollow">
                                    <i class="mdi-action-delete icon-color-red"></i>
                                </a>
                            </td>
                        </tr>  
                @endforeach
                
            </tbody>
            </table>
            </div>
            
        </div>
    </div>
    

@endsection
