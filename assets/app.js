
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import './bootstrap';
import noUiSlider from  'nouislider';
import 'nouislider/distribute/nouislider.css'

const slider = document.getElementById('slider');

if(slider)
{
    const min = document.getElementById('min')
    const max = document.getElementById('max')
    const minValue = Math.floor(parseInt(slider.dataset.min, 10) / 10) * 10
    const maxvalue = Math.ceil(parseInt(slider.dataset.max, 10)/  10) * 10
    const  range =  noUiSlider.create(slider, {
        start: [min.value || minValue , max.value || maxvalue],
        connect: true,
        range: {
            'min': minValue,
            'max':maxvalue,
        }
    });


    range.on('slide', function (values,handle)
    {
        if(handle === 0 )
        {
            min.value = Math.round(values[0])
        }
        if (handle === 1)
        {
            max.value =Math.round(values[1])
        }
        console.log(values,handle)
    })
}
