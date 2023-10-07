


<table class="table border table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Amount</th>
            <th>Description</th>
            <th>Action</th>
        </tr>

    </thead>
    <tbody>
        @if ($DepositHistory->count() > 0)

        @php
         if(request('page')>1)

        $counter = ((request('page')-1)*10) +1;
        else
        $counter = 1;
        @endphp
        @foreach ($DepositHistory as $customer )

            <tr>
                <td>{{$counter}}</td>

                <td>{{$customer->amount}}</td>
                <td>{{$customer->description}}</td>
                <td>
                    <a href="{{route('deposit.edit',$customer->id)}}?page={{request('page',1)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary mx-2">
                        <i class="bi bi-pencil"></i></a>
                </td>
            </tr>
            @php
            $counter++;
        @endphp
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="4" >No record found</td>
        </tr>
        @endif

    </tbody>
</table>
