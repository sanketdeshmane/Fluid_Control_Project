<script>
        (function($) {
            "use strict";
            // Add active state to sidbar nav links
            var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
            $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
                if (this.href === path) {
                    $(this).addClass("active");
                }
            });
            // Toggle the side navigation
            $("#sidebarToggle").on("click", function(e) {
                e.preventDefault();
                $("body").toggleClass("sb-sidenav-toggled");
            });
        })(jQuery);
    </script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['defect_status', 'id'],
          <?php
            $id = get_id($link,'quality_control',$_SESSION['email']);
            $sql = "SELECT  * FROM defects WHERE found_by= '$id' and defect_status='ACCEPTED_1'";
            $fire = mysqli_query($link,$sql);
            $accpted_count=0;
            while(mysqli_fetch_assoc($fire)){
                $accpted_count = $accpted_count+1;
            }
            $sql = "SELECT  * FROM defects WHERE found_by= '$id' and defect_status='DISAPPROVED'";
            $fire = mysqli_query($link,$sql);
            $disapted_count=0;
            while(mysqli_fetch_assoc($fire)){
                $disapted_count = $disapted_count+1;
            }
            $sql = "SELECT  * FROM defects WHERE found_by= '$id' and defect_status='REJECTED'";
            $fire = mysqli_query($link,$sql);
            $sumbmit_count=0;
            while(mysqli_fetch_assoc($fire)){
                $sumbmit_count = $sumbmit_count+1;
            }
            $sql = "SELECT  * FROM defects WHERE found_by= '$id' and defect_status='ASSIGNED'";
            $fire = mysqli_query($link,$sql);
            $assign_count=0;
            while(mysqli_fetch_assoc($fire)){
                $assign_count = $assign_count+1;
            }
            $sql = "SELECT  * FROM defects WHERE found_by= '$id' and defect_status='CLOSED'";
            $fire = mysqli_query($link,$sql);
            $closed_count=0;
            while(mysqli_fetch_assoc($fire)){
                $closed_count = $closed_count+1;
            }
            echo"['APPROVED CONTAINMENT',".$accpted_count."],";
            echo"['CLOSED DEFECT',".$closed_count."],";
            echo"['ASSIGNED',".$assign_count."],";
            echo"['DISAPPROVED CONTAINMENT',".$disapted_count."],";
            echo"['REJECTED PROBLEM SOLUTION',".$sumbmit_count."],";
            
          ?>
        ]);

        var options = {
          title: 'Approved & Disapproved Status',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
</body>

</html>