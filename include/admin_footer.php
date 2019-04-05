  <script src="js/jquery.min.js"></script>
  <script src="js/materialize.min.js"></script>
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

  <script>
      var map;
      var iconBase = 'images/indicator_gif/';
      var contentDefinition = '<div id="content"> <h1>'+location_title+'</h1> </div>';
      //var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          //CAGAYAN DE ORO CITY
          center: {lat: 8.4822197, lng: 124.6472168},
          zoom: 12
        });
        var google_counter = 0;
        var xhr;
        function getDataFromDb(){
            xhr = $.ajax({
              url: "controller/getrate.php",
              type: "GET",
              success: (response) => {

                  var google_rate_pressure = JSON.parse(response);

                  var pressure_rate_google = google_rate_pressure.pressure[google_counter];
                  var g_latitude = google_rate_pressure.lat[0];
                  var g_longitude = google_rate_pressure.lon[0];

                  //CUSTOM INDICATOR
                  var high = 300;
                  var average = 200;
                  var low = 100;

                  // console.log(pressure_rate_google);
                  if( pressure_rate_google >= high){
                    var icons = {
                      info: {
                        icon: iconBase + 'green_indicator_gif.gif',
                      }
                    };
                  }
                  if((pressure_rate_google >= average) && (pressure_rate_google < high)){
                    var icons = {
                      info: {
                        icon: iconBase + 'yellow_indicator_gif.gif',
                      }
                    };
                  }if((pressure_rate_google <= 200) && (pressure_rate_google > 1)){
                    var icons = {
                      info: {
                        icon: iconBase + 'red_indicator_gif.gif',
                      }
                    };
                  }
                  if(pressure_rate_google == 0 || pressure_rate_google == undefined){
                    var icons = {
                      info: {
                        icon: "images/icon_indicator/" + 'no_signal.gif',
                      }
                    };
                  }
                  google_counter++;
                  var features = [
                    {
                      position: new google.maps.LatLng(g_latitude, g_longitude),
                      type: 'info'
                    }
                  ];
                  // Create markers.
                  features.forEach(function(features) {
                    var marker = new google.maps.Marker({
                      position: features.position,
                      icon: icons[features.type].icon,
                      map: map,
                    });
                  });
              }
            });
          } //end function get db
          setInterval(function(){
            getDataFromDb();
            ;}, 1000 );
      }
    </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4Bm2h4N3i0PEK_HXh-FDItgDLd0PTNyA&callback=initMap"
    async defer></script>

  <script type="text/javascript">
    $(document).ready(function(){
      var newPass = $('#newPassword');
      var confirmPass = $('#confirmPassword');
      $('#newPassword').on('change',function() {
        console.log(newPass.val());
        passwordCompare();
      });

      $('#confirmPassword').on('change',function() {
        console.log(confirmPass.val());
        passwordCompare();
      });

      function passwordCompare() {
        if(newPass.val() !== confirmPass.val()){
          $('#errorCompare').html("Password didn't match!");
        } else {
          $('#errorCompare').html("");
        }
      }
    });
  </script>
  <script>
    var callTimer = setInterval(timer, 1000);

    function timer(){
      var d = new Date();
      document.getElementById("timeJS").innerHTML = d.toLocaleTimeString();
    }

    var current_location = document.getElementById('locationfetch').innerHTML;
    //GET THE INFO FROM DB

    //counter for indexing
    var counter = 0;
    var rate_counter = 0;

    $(document).ready(function(){
      // getChartData();
      counter = 0;
      limitby = 10;

        function getChartData(){
          var xhr;
          xhr = $.ajax({
            url: "controller/getrate.php",
            type: "GET",
            success: (response) => {
              var parse_info = JSON.parse(response);
              var count = 0;
              var data = {
                labels : ["1 s","2 s","3 s","4 s","5 s","6 s", "7 s", "8 s", "9 s", "10 s", "11 s"],
                datasets : [
                  {
                    label: "Water Pressure",
                    fillColor : "rgba(220,220,220,0.5)",
                    strokeColor : "rgba(220,220,220,1)",
                    pointColor : "rgba(220,220,220,1)",
                    pointStrokeColor : "#fff",
                    data: parse_info.pressure
                    // data: [57,2,4,235,765,77]
                  },
                  {
                    label: "Water Flow",
                    fillColor : "rgba(151,187,205,0.5)",
                    strokeColor : "rgba(151,187,205,1)",
                    pointColor : "rgba(151,187,205,1)",
                    pointStrokeColor : "#fff",
                    data: parse_info.waterflow
                    // data: [321,45,87,100,36,46]
                  }
                ]
              }

                var get_psi = parse_info.pressure[rate_counter];
                var flow = parse_info.waterflow[rate_counter];

                //transfer to html
                document.getElementById('psi').innerHTML = get_psi;
                document.getElementById('flow').innerHTML = flow;

              var json_info = {
                id: parse_info.id[counter]
              };

              //UPDATE DATA SET STATUS = 1
              var update_xhr;
              update_xhr = $.ajax({
                url: "controller/updaterate.php",
                type: "POST",
                data: {json_info},
                success: (response_update) =>{
                  console.log(response_update);
                }
              });
              // counter++;
              if(json_info.id == null || json_info.id == undefined){
                counter *= 0;
              }else{
                counter++;
              }
              //UPDATE DATA
              var labels = data["labels"];
              var dataSetA = data["datasets"][0]["data"];
              var dataSetB = data["datasets"][1]["data"];
              labels.shift();
              count+=5;
              if(count > 60){
                count=count*0
                count += 5
              }

              labels.push(count.toString()+" s");
              var newDataA = dataSetA[10];
              var newDataB = dataSetB[10];
              dataSetA.push(newDataA);
              dataSetB.push(newDataB);
              dataSetA.shift();
              dataSetB.shift();

            var optionsAnimation = {
              //Boolean - If we want to override with a hard coded scale
              scaleOverride : true,
              //** Required if scaleOverride is true **
              //Number - The number of steps in a hard coded scale
              scaleSteps : 20,
              //Number - The value jump in the hard coded scale
              scaleStepWidth : 20,
              //Number - The scale starting value
              scaleStartValue : 0
            }

            var optionsNoAnimation = {
              animation : false,
              //Boolean - If we want to override with a hard coded scale
              scaleOverride : true,
              //** Required if scaleOverride is true **
              //Number - The number of steps in a hard coded scale
              scaleSteps : 20,
              //Number - The value jump in the hard coded scale
              scaleStepWidth : 9,
              //Number - The scale starting value
              scaleStartValue : 0
            }

            //Get the context of the canvas element we want to select
            var ctx = document.getElementById("myChart").getContext("2d");
            var optionsNoAnimation = {animation : false}
            var myNewChart = new Chart(ctx);
            myNewChart.Line(data, optionsAnimation);
              setInterval(function(){
                myNewChart.Line(data, optionsNoAnimation);
                ;}, 1000 );
              // console.log(response_update);
              // var optionsAnimation = {
              //   //Boolean - If we want to override with a hard coded scale
              //   scaleOverride : true,
              //   //** Required if scaleOverride is true **
              //   //Number - The number of steps in a hard coded scale
              //   scaleSteps : 20,
              //   //Number - The value jump in the hard coded scale
              //   scaleStepWidth : 20,
              //   //Number - The scale starting value
              //   scaleStartValue : 0
              // }
              //
              // var optionsNoAnimation = {
              //   animation : false,
              //   //Boolean - If we want to override with a hard coded scale
              //   scaleOverride : true,
              //   //** Required if scaleOverride is true **
              //   //Number - The number of steps in a hard coded scale
              //   scaleSteps : 20,
              //   //Number - The value jump in the hard coded scale
              //   scaleStepWidth : 9,
              //   //Number - The scale starting value
              //   scaleStartValue : 0
              // }
              //
              // //Get the context of the canvas element we want to select
              // var ctx = document.getElementById("myChart").getContext("2d");
              // var optionsNoAnimation = {animation : false}
              // var myNewChart = new Chart(ctx);
              // myNewChart.Line(data, optionsAnimation);
              //   setInterval(function(){
              //     myNewChart.Line(data, optionsNoAnimation);
              //     getChartData();
              //     ;}, 5000 );

              // console.log(counter);


            //END ofresponse
            // setInterval(function(){
            //   getChartData();
            //   // myNewChart.Line(data, optionsNoAnimation)
            //   ;}, 5000 );
            // }
            // PROBLEM: DATA RETRIEVAL ( FETCHING SAME DATA ) -> MUST WORK WITH DATABASE STATUS UPDATE FROM 0 to 1 (EVERY SECONDS)
            // PRACTICE ANOTHER FILE WITH AJAX REAL-TIME
            // getChartData();
          }
          }); //xhr end
        }
        var get_live_data = setInterval(getChartData, 5000);
    });
  </script>
  <script src="js/chart.min.js"></script>
  </body>
</html>
