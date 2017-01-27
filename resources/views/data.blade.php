
<table class="table" align="center" border="1px" style="background-color: #46b8da">
    <thead>
    <tr>
        <th>Num1</th>
        <th>Num2</th>
        <th>Num3</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Phone number</th>
        <th>Address</th>
        <th>Password</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($data->toArray() as $key => $item)
        @foreach ($item as $v)
        <tr align="center">
            <td> {{$v['num']}}  </td>
            <td> {{$v['num1']}}  </td>
            <td> {{$v['num2']}}  </td>
            <td> {{$v['first_name']}}  </td>
            <td> {{$v['last_name']}}  </td>
            <td> {{$v['email']}}  </td>
            <td> {{$v['phone_number']}}  </td>
            <td> {{$v['address']}}  </td>
            <td> {{$v['password']}}  </td>

        </tr>
    @endforeach
        @endforeach
    </tbody>
</table>
<div align="center">
    <a href="/import"><b>Back</b></a>
</div>