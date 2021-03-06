@extends('app')

@section('content')

    <div class="row">
        <ol class="cd-breadcrumb custom-separator">
            <li><a href="{!! url('screen') !!}">หน้าหลัก</a></li>         
            <li class="current"><em>จัดการผู้ใช้</em></li>
        </ol>
    </div>

    <div class="row">
        <a class="waves-effect waves-light btn" href="{{ route('user.create') }}">เพิ่มผู้ใช้</a>
    </div>

    <div class="row">
        <div class="col s12">
            
            <div id="userTable_wrapper" class="dataTables_wrapper no-footer"> 
            <table id="userTable" class="responsive-table striped" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>ชื่อผู้ใช้</th>
                        <th>ที่อยู่</th>
                        <th>การใช้งาน</th>
                        <th>สถานะ</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php $i=0; ?>              
                    @foreach($user as $key => $value)
                     <?php $i++;  ?>
                        <tr data-id="{{ $value->id }}">
                            <td>{{ $i }}</td>   
                            <td>{{ $value->name }}</td>                        
                            <td>{{ $value->username }}</td>                          
                            <td>{{ $value->address }}</td>
                            <td>
                                @if( $value->activated == 1 )
                                    <div class="btn-floating waves-effect waves-light green tooltipped" data-position="top" data-delay="50" data-tooltip="เปิด"><i class="mdi-action-done"></i></div>
                                @else
                                    <div class="btn-floating waves-effect waves-light red tooltipped" data-position="top" data-delay="50" data-tooltip="ปิด"><i class="mdi-action-highlight-remove"></i></div>
                                @endif
                            </td>   
                            <td>
                                @if( $value->status == 1 )
                                    <span class="badge-game green">ผู้ดูแลระบบ</span>
                                @elseif( $value->status == 2 )
                                    <span class="badge-game red">ผู้วิจัย</span>
                                @else
                                     <span class="badge-game blue">ผู้คัดกรอง</span>
                                @endif
                            </td>                       
                            <td>                           	 
                                <a  class="btn-floating waves-effect waves-light green tooltipped" data-position="top" data-delay="50" data-tooltip="แก้ไข" href="{{ route( 'user.edit', Crypt::encrypt($value->id) ) }}">
                                    <i class="mdi-editor-mode-edit icon-color-qray"></i>
                                </a>
                                <a class="btn-floating waves-effect waves-light red btn-user-delete tooltipped" data-position="top" data-delay="50" data-tooltip="ลบ" href="{{ route( 'user.destroy', Crypt::encrypt($value->id) ) }}" data-method="delete" data-confirm="ต้องการลบผู้ใช้ {{ e($value->name) }}" data-remote="true" rel="nofollow">
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
