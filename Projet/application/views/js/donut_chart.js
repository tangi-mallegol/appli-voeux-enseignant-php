function drawDonutChart(labelList, valueList){

  var sizeLabelList = labelList.length;
  var sizeValueList = valueList.length;
  // if the label and value size are not same then stop function.
  if(sizeLabelList != sizeValueList){
    alert("Une erreur est intervenue lors de la construction du graph.");
    return;
  }

  var svg = d3.select("#ChartCours")
    .append("svg")
    .append("g")

  svg.append("g")
    .attr("class", "slices");
  svg.append("g")
    .attr("class", "labels");
  svg.append("g")
    .attr("class", "lines");

  var width = 800,
      height = 375,
    radius = Math.min(width, height) / 2;

  var pie = d3.layout.pie()
    .sort(null)
    .value(function(d) {
      return d.value;
    });

  var arc = d3.svg.arc()
    .outerRadius(radius * 0.7)
    .innerRadius(radius * 0.5);

  var outerArc = d3.svg.arc()
    .innerRadius(radius * 0.9)
    .outerRadius(radius * 0.9);

  svg.attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

  var key = function(d){ return d.data.label; };

  var color = d3.scale.ordinal()
    .domain(labelList)
    .range(["#43846F", "#5F996B", "#78AA58", "#BAD55A",
            "#8DA422", "#B3695C", "#D07862", "#D1C44B",
            "#E6CC5C", "#FCCE83", "#E3A171", "#CF7E67",
            "#B4DAB8", "#E6D193", "#E5A891", "#E47E8F",
            "#DDCBB7", "#E0B99A", "#E87E70", "#8B756A",
            "#444C57", "#D1AD73", "#BEA788", "#D19F7C",
            "#AB8377", "#665D56"]);
    // You can use these colors.
    //The maximum number of labels depend of the number of colors

  var labelCompt = 0;
  var data = [];
  var currentObject = {};
  // open php data and create objects with it
  for (var i = 0;i < sizeLabelList;i++){
    if(valueList[i] != 0){
      currentObject = {"label": labelList[i], "value": valueList[i]};
      data.push(currentObject);
    }
  }

  /* ------- PIE SLICES -------*/
  var slice = svg.select(".slices").selectAll("path.slice")
    .data(pie(data), key);

  slice.enter()
    .insert("path")
    .style("fill", function(d) { return color(d.data.label); })
    .attr("class", "slice");

  slice
    .transition().duration(1000)
    .attrTween("d", function(d) {
      this._current = this._current || d;
      var interpolate = d3.interpolate(this._current, d);
      this._current = interpolate(0);
      return function(t) {
        return arc(interpolate(t));
      };
    })

  slice.exit()
    .remove();

  /* ------- TEXT LABELS -------*/

  var text = svg.select(".labels").selectAll("text")
    .data(pie(data), key);

  text.enter()
    .append("text")
    .attr("dy", ".35em")
    .text(function(d) {
      return d.data.label;
    });

  function midAngle(d){
    return d.startAngle + (d.endAngle - d.startAngle)/2;
  }

  text.transition().duration(1000)
    .attrTween("transform", function(d) {
      this._current = this._current || d;
      var interpolate = d3.interpolate(this._current, d);
      this._current = interpolate(0);
      return function(t) {
        var d2 = interpolate(t);
        var pos = outerArc.centroid(d2);
        pos[0] = radius * (midAngle(d2) < Math.PI ? 1 : -1);
        return "translate("+ pos +")";
      };
    })
    .styleTween("text-anchor", function(d){
      this._current = this._current || d;
      var interpolate = d3.interpolate(this._current, d);
      this._current = interpolate(0);
      return function(t) {
        var d2 = interpolate(t);
        return midAngle(d2) < Math.PI ? "start":"end";
      };
    });

  text.exit()
    .remove();

  /* ------- SLICE TO TEXT POLYLINES -------*/

  var polyline = svg.select(".lines").selectAll("polyline")
    .data(pie(data), key);

  polyline.enter()
    .append("polyline");

  polyline.transition().duration(1000)
    .attrTween("points", function(d){
      this._current = this._current || d;
      var interpolate = d3.interpolate(this._current, d);
      this._current = interpolate(0);
      return function(t) {
        var d2 = interpolate(t);
        var pos = outerArc.centroid(d2);
        pos[0] = radius * 0.95 * (midAngle(d2) < Math.PI ? 1 : -1);
        return [arc.centroid(d2), outerArc.centroid(d2), pos];
      };
    });

  polyline.exit()
    .remove();
}
