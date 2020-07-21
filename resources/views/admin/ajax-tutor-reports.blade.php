<table class="table" style="margin-top:30px;">
  <thead class=" text-primary">

  </thead>
  <tbody>
    <tr>
      <td>Tutor Name</td>
      <td  style="border-left: 1px solid #ccc;">
        {{$tutor->first_name}} {{$tutor->last_name}}
      </td>
    </tr>
    <tr>
      <td>Pay Period</td>
      <td style="border-left: 1px solid #ccc;">{{$period}}</td>
    </tr>
    <?php
    $sum='';
    ?>
    @foreach($earnings as $earning)
    <tr>
      <td>{{SCT::getClientName($earning->user_id)->first_name}} {{SCT::getClientName($earning->user_id)->last_name}}
        @if(SCT::checkFirstEarning($earning->user_id,$earning->tutor_id) == 0)
        Earnings*
        @else
        Earnings
        @endif
      </td>
      <td style="border-left: 1px solid #ccc;">{{$earning->earning}} $</td>
    </tr>
    <?php
    $sum = (float)$sum+(float)$earning->earning;
    // dd($sum);
    ?>
    @endforeach
    <tr  style="border-bottom: 1px solid #ccc;">
      <td><strong>Total Earnings</strong></td>
      @if($sum != '')
      <td  style="border-left: 1px solid #ccc;"><strong>{{$sum}} $</strong></td>
      @else
      <td style="border-left: 1px solid #ccc;"><strong>0 $</strong></td>
      @endif
    </tr>
  </tbody>
</table>
