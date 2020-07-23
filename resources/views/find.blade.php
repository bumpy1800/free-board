<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <style>
    .green_window {
        display: inline-block;
        width: 366px; height: 40px;
        border: 3px solid #200400;
        background: white;
    }
    .input_text {
        width: 348px; height: 21px;
        margin: 6px 0 0 9px;
        border: 0;
        line-height: 21px;
        font-weight: bold;
        font-size: 16px;
        outline: none;
    }
    .sch_smit {
        width: 54px; height: 40px;
        margin: 0; border: 0;
        vertical-align: top;
        background: #200400;
        color: white;
        font-weight: bold;
        border-radius: 1px;
        cursor: pointer;
    }
    .sch_smit:hover {
        background: #56C82C;
    }
    #close {
      text-align: center;
      margin-top: 10px;
    }

    table {
      margin-top: 10px;
      margin-left: auto;
      margin-right: auto;
      width: 100%;
      text-align:center;
    }
    #result {
      border: 1px solid black;
      border-top: 0px;
      margin-left: 15px;
      margin-right: 15px;
    }
    td {
      border-top: 1px solid black;
    }
    .pagination {
      justify-content: center!important;
      margin-top: 10px;
      margin-bottom: 0px;
    }

    .heads {
      display: none;
    }
  </style>
</head>
<!-- HTML -->
<body>
<form method="POST" action="/admin/galleryFind">
  @method('POST')
  @csrf
  <div style="text-align: center; margin-top: 10px;">
    <span class='green_window'>
    <input id=text type="text" class='input_text' name="search" onkeydown="enterSearch()" placeholder="검색어를 입력해주세요." /></span>
    <input type="submit" class='sch_smit' value="검색"/>
  </div>
</form>

<div id="result">
  <table>
      @foreach ($results as $result)
        <tr>
          <td><a href="" id="result{{ $result->id }}" type="text" onclick="setParentText({{ $result->id }})">{{ $result->name }}</a></td>
        </tr>
        <ul id="{{ $result->id }}" class="heads">
          @php
            $headArr = explode("/", $result->heads);
          @endphp
          <li id="sel0" class="sel" value="sel0" onclick="change('sel0');"><i id="head" class="fas fa-check"></i>일반</li>
          <input id="sendHead" type="hidden" name="head" value="일반">
          @for($i = 0; $i < count($headArr) ; $i++)
            <li id="sel{{ $i+1 }}" value="sel{{ $i+1 }}" onclick="change('sel{{ $i+1 }}');">{{ $headArr[$i] }}</li>
          @endfor
        </ul>
      @endforeach
  </table>
</div>

  {{ $results->links() }}

<div id="close">
  <input type="button" class="sch_smit" value="닫 기" onclick="self.close();" />
</div>


<!-- JAVASCRIPT -->
<script type="text/javascript">
  function setParentText(id){
    opener.document.getElementById("resultName").value = document.getElementById("result" + id).text;
    opener.document.getElementById("idH").value = id;

    /*<li id="sel1" class="sel" value="sel1" onclick="change('sel1');"><i id="head" class="fas fa-check"></i>일반</li>
    <input id="sendHead" type="hidden" name="head" value="일반">
    <li id="sel2" value="sel2" onclick="change('sel2');">일반2</li>
    <li id="sel3" value="sel3" onclick="change('sel3');">일반3</li>
    <li id="sel4" value="sel4" onclick="change('sel4');">일반4</li>
    <li id="sel5" value="sel5" onclick="change('sel5');">일반5</li>*/
    //alert(document.getElementById('heads').innerHTML);
    opener.document.getElementById('sub_list').innerHTML = document.getElementById(id).innerHTML;

    self.close();
  }
</script>
</body>
