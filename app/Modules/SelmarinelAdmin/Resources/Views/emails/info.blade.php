<body>
    <table style="width: 100%; height: auto">
        <tr>
            <th><h2 style="padding:20px">Name : <strong>{{$name}}</strong></h2></th>
        </tr>
        <tr>
            <td style="text-align: right; font-weight: bold; width: 50%;">Телефон</td>
            <td style="text-align: left; font-size: larger; font-style: italic; font-weight: bold; width: 50%">{{$phone}}</td>
        </tr>
        <tr>
            <td style="text-align: right; font-weight: bold; width: 50%;">Почта</td>
            <td style="text-align: left; font-size: larger; font-style: italic; font-weight: bold; width: 50%">{{$email}}</td>
        </tr>
        <tr>
            <td colspan="2" style="letter-spacing: 2px">
                {{$text}}
            </td>
        </tr>
    </table>
</body>