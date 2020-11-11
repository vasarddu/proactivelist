@extends('layouts.app')
@section('title', '首页')

@section('content')
    <a href="javascript:location.reload();">换一批</a>
    <div id="d3_cloud"></div>

    <script src="{{ URL::asset('js/d3.min.js') }}"></script>
    <script src="{{ URL::asset('js/d3.layout.cloud.js') }}"></script>
    <script>
        var words_list = {!! htmlspecialchars_decode($items)!!};
        var fill = d3.scale.category20();
        var layout = d3.layout.cloud()
            .size([950, 650])
            .words(words_list.map(function(d) {
                return {text: d, size: 10 + Math.random() * 79, test: "haha"};
            }))
            .padding(15)
            .rotate(function() { return ~~(Math.random() * 1) * 75; })
            .font("Impact")
            .fontSize(function(d) { return d.size; })
            .on("end", draw);

        layout.start();

        function draw(words) {
            d3.select("#d3_cloud").append("svg")
                .attr("width", layout.size()[0])
                .attr("height", layout.size()[1])
                .append("g")
                .attr("transform", "translate(" + layout.size()[0] / 2 + "," + layout.size()[1] / 2 + ")")
                .selectAll("text")
                .data(words)
                .enter().append("text")
                .style("font-size", function(d) { return d.size + "px"; })
                .style("font-family", "Impact")
                .style("fill", function(d, i) { return fill(i); })
                .attr("text-anchor", "middle")
                .attr("transform", function(d) {
                    return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
                })
                .text(function(d) { return d.text; });
        }
    </script>
@stop





