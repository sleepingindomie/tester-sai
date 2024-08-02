<!-- resources/views/partials/container_detail.blade.php -->

<table class="table table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Container Number</th>
            <th>Seal Number</th>
            <th>Outer Quantity</th>
            <th>Outer Package Type</th>
            <th>Net Weight</th>
            <th>Gross Weight</th>
            <th>Gross Meas</th>
            <th>BL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($containers as $cont)
            <tr>
                <td>{{ $cont->container_no }}</td>
                <td>{{ $cont->seal_no }}</td>
                <td>{{ $cont->outer_quantity }}</td>
                <td>{{ $cont->outer_package_type }}</td>
                <td>{{ $cont->net_weight }}</td>
                <td>{{ $cont->gross_weight }}</td>
                <td>{{ $cont->gross_meas }}</td>
                <td>{{ $cont->bl }}</td>
            </tr>
        @endforeach
    </tbody>                                                                             
</table>
