<!-- App js -->
<script src="{{ asset('backend/Admin/dist/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('backend/Admin/dist/assets/js/app.js') }}"></script>

<!-- Knob charts js -->
<script src="{{ asset('backend/Admin/dist/assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

<!-- Sparkline Js-->
<script src="{{ asset('backend/Admin/dist/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

<script src="{{ asset('backend/Admin/dist/assets/libs/morris.js/morris.min.js') }}"></script>

<script src="{{ asset('backend/Admin/dist/assets/libs/raphael/raphael.min.js') }}"></script>

<!-- Dashboard init-->
<script src="{{ asset('backend/Admin/dist/assets/js/pages/dashboard.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const revenueData = @json($revenueChart ?? []);

        // safety check
        if (!revenueData.length) {
            console.warn('No chart data available');
            return;
        }

        Morris.Line({
            element: 'revenue-chart',
            data: revenueData,
            xkey: 'month',
            ykeys: ['revenue'],
            labels: ['Revenue'],
            parseTime: false,
            lineColors: ['#0d6efd'],
            hideHover: 'auto',
            resize: true
        });

    });
</script>

</body>

</html>
