<?php

\app\assets\JqPlotAsset::register($this);
?>

	<div id="tabs" class="tabs">
		<ul class="nav nav-tabs" role="tablist" id="grafieken">
			<li role="presentation" class="active"><a href="#tabs-1">Uitslagen</a></li>
			<li role="presentation"><a href="#tabs-2">Goals/Spelers</a></li>
		</ul>
		<div class="tab-content">
			<div id="tabs-1" class="tab active">
				<p>Uitslagen gespeelde matchen</p>

				<div id="chart1" style="width: 50%;margin-top: 50px;text-align: center">

				</div>
			</div>

			<div id="tabs-2" class="tab">
				<p>Gemaakte goals en aanwezige spelers per match</p>

				<div id="chart2" style="width: 50%;margin-top: 50px;text-align: center">

				</div>
			</div>
		</div>
	</div>

<?php
$script = <<< JS
$(document).ready(function(){
  var data = [
    ['Gewonnen', {$aUitslagen['gewonnen']}],['Verloren', {$aUitslagen['verloren']}], ['Gelijk', {$aUitslagen['gelijk']}]
  ];

	$.jqplot.config.enablePlugins = false;

  var plot1 = jQuery.jqplot ('chart1', [data],
    {
      seriesDefaults: {
        // Make this a pie chart.
        renderer: jQuery.jqplot.PieRenderer,
        rendererOptions: {
          // Put data labels on the pie slices.
          // By default, labels show the percentage of the slice.
          showDataLabels: true,
          dataLabels: 'value'
        }
      },
      legend: { show:true, location: 'e' }
    }
  );

  var plot2 = $.jqplot ('chart2', [[{$sAanwezigheden}], [{$sGoals}]]);

	jQuery('.tabs .nav.nav-tabs a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');

        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();

        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
		if (currentAttrValue === '#tabs-1')
		{
			plot1.replot();
		}
		else if (currentAttrValue === '#tabs-2')
		{
			plot2.replot();
		}
        e.preventDefault();
    });
});
JS;
$this->registerJs($script);