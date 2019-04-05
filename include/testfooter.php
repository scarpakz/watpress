<script src="js/plotly.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/materialize.min.js"></script>
<!-- <script src="js/chart.min.js"></script> -->

<script type="text/javascript">

    Plotly.plot('chart',[{
      y:[0],
      type: 'line'
    }]);

    Plotly.plot('chart',[{
      y:[0],
      type: 'line'
    }]);

    var cnt = 0;
    var response_counter = 0;

    setInterval(function(){
      var xhr;
      xhr = $.ajax({
          url: "controller/getrate.php",
          type: "GET",
          success: (response) => {
            var data = JSON.parse(response);
            var data_id = {
              id: data.id[response_counter]
            };
            var data_pressure = data.pressure[response_counter]/5;
            var data_waterflow = data.waterflow[response_counter]/5;

            console.log(data_pressure);
            //not true
            if(!(isNaN(data_pressure))) {
              document.getElementById('psi').innerHTML = data_pressure;
              document.getElementById('flow').innerHTML = data_waterflow;
              var update_xhr;
              update_xhr = $.ajax({
                url: "controller/updaterate.php",
                type: "POST",
                data: {data_id},
                success: (response_update) =>{
                  //set status = 1 from 0, view once only
                }
              });
              response_counter++;
            }
            else{
              document.getElementById('psi').innerHTML = 0;
              document.getElementById('flow').innerHTML = 0;
              //reset counter
              // console.log("responseCounter =>",response_counter);
              response_counter*=0;
            }
            // trace 0
            Plotly.extendTraces('chart',{ y:[[data_pressure || 0]]}, [1]);
            //trace 1
            Plotly.extendTraces('chart',{ y:[[data_waterflow || 0]]}, [0]);
          }
      }); //end ajax request

      cnt++;
      if(cnt > 5000){
        Plotly.relayout('chart',{
          xaxis:{
            range: [cnt-5000,cnt]
          }
        });
      }
    },1000);

</script>

<script type="text/javascript">
  var callTimer = setInterval(timer, 1000);

  function timer(){
    var d = new Date();
    document.getElementById("timeJS").innerHTML = d.toLocaleTimeString();
  }

  //custom script
  $(document).ready(function(){

    var getLiveCounter = 0;
    function getLiveData(){

    } //END FUNCTION
    var liveInterval = setInterval(getLiveData, 5000);
  });
</script>
<script>
    $(document).ready(function(){
        //Initialize modal
        $('.modal').modal();

        //SELECT
        $('select').formSelect();

        //DROPDOWN
        $('.dropdown-trigger').dropdown();

        //MODAL
        $('.modal').modal();
      });
</script>
</body>
</html>
