<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Javascript</title>

    <style>
        table { width: 70%; }
        table, th, td { border: solid 1px #DDD;
            border-collapse: collapse; padding: 2px 3px; text-align: center;
        }
    </style>
</head>
<body>
    <button onclick="addnew()">Add new Row</button>
<table>

    <thead>
        <td>Name</td>
        <td>Mark1</td>
        <td>Mark2</td>
        <td>Mark3</td>
        <td>Total</td>
        <td>Rank</td>
        <td></td>

   </thead>

<tbody id="tbrw">
    @if($result)
    @foreach($result as $val)
    <tr>
        <td>{{$val->student_name}}</td>
        <td>{{$val->mark_1}}</td>
        <td>{{$val->mark_2}}</td>
        <td>{{$val->mark_3}}</td>
        <td>{{$val->total}}</td>
        <td>{{$val->rank}}</td>
        <td></td>

    </tr>
    @endforeach
    @endif
</tbody>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function addnew()
    {
        var srdata='<tr><td><input type="text" name="input_name" id="input_name" /></td><td><input type="text" name="input_mark1" id="input_mark1" /></td><td><input type="text" name="input_mark2" id="input_mark2" /></td><td><input type="text" name="input_mark3" id="input_mark3" /></td><td id="totalm">0</td><td>-</td><td><button onclick="formsubmit()">Submit</button></td></tr>';
        $("#tbrw").append(srdata);
        sumof();
    }

    function sumof()
    {
        $("#input_mark1,#input_mark2,#input_mark3").on('keyup',function()
        {
            var m1=$("#input_mark1").val() ? $("#input_mark1").val(): 0;
            var m2=$("#input_mark2").val() ? $("#input_mark2").val() : 0;
            var m3=$("#input_mark3").val() ? $("#input_mark3").val(): 0;
            var total= parseInt(m1)+parseInt(m2)+parseInt(m3);
            $("#totalm").html(total);
        });
    }

    function formsubmit()
    {
        var name=$("#input_name").val()
        var m1=$("#input_mark1").val() ? $("#input_mark1").val(): 0;
            var m2=$("#input_mark2").val() ? $("#input_mark2").val() : 0;
            var m3=$("#input_mark3").val() ? $("#input_mark3").val(): 0;
            if(m1!=0 && m2!=0 && m3!=0 && name!="")
            {
                $.ajax({
                    type:'post',
                    url:'{{url("reg")}}',
                    data:{"name":name,"m1":m1,"m2":m2,"m3":m3},
                    success:function(data)
                    {
                        if(data)
                        {
                            window.location.reload();
                        }
                    }
                })
            }
            else
            {
                alert("Enter requried fields");
            }
    }
    </script>
</body>
</html>
