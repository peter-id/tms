@extends('frontend.layouts.app')

@section('title', __('Insurance Record'))




@section('content')
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">

                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Date</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Lorry</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Amount</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Expire On</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($insurances as $insurance)
                        <tr class="nk-tb-item">
                        <td class="nk-tb-col tb-col-lg">
                            <span>{{ reformatDateTime($insurance->created_at, 'd-m-Y') }}</span>
                        </td>
                        <td class="nk-tb-col">
                            <div class="user-card">
                                <div class="user-info">
                                    <span class="tb-lead">{{ $insurance->lorry->plat_number }}<span class="dot dot-success d-md-none ml-1"></span></span>
                                    <span>{{ $insurance->lorry->brand." ".$insurance->lorry->model }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="nk-tb-col tb-col-mb">
                            <span class="tb-amount">{{ displayPrice($insurance->amount) }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span>{{ $insurance->expire_date }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            {!! ($insurance->is_read == 0)? '<span class="tb-status text-success">Enabled</span>' : '<span class="tb-status text-dark">Disabled</span>' !!}
                        </td>
                        <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="{{ route('frontend.user.lorry.insurance.view', $insurance->id) }}"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                <li><a href="{{ route('frontend.user.lorry.insurance.edit', $insurance->id) }}"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                @if($insurance->is_read == 0)
                                                    <li>
                                                        <a onclick="return confirm('Are you user want to mute this service?')" href="{{ route('frontend.user.lorry.insurance.mute', $insurance->id) }}"><em class="icon ni ni-bell-off">
                                                            </em><span>Mute</span>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a onclick="return confirm('Are you user want to unmute this service?')" href="{{ route('frontend.user.lorry.insurance.unmute', $insurance->id) }}"><em class="icon ni ni-bell">
                                                            </em><span>Unmute</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div><!-- card -->
    </div>
@endsection
@push('after-scripts')
@endpush
