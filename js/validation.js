// Bootstrap validation
// by Matthew Hillman
// 2017 v1
$(function()
{
	function randomNumber(min, max)
	{
		return Math.floor(Math.random() * (max - min + 1) + min);
	}
	$('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));
	$('#contactform').bootstrapValidator(
	{
		fields:
		{
			contactformname:
			{
				validators:
				{
					stringLength:
					{
						min: 2,
					},
					notEmpty:
					{
						message: 'Please input your name'
					}
				}
			},
			contactformemail:
			{
				validators:
				{
					notEmpty:
					{
						message: 'Please input your email address'
					},
					emailAddress:
					{
						message: 'Please input a valid email address'
					}
				}
			},
			contactformphone:
			{
				validators:
				{
					stringLength:
					{
						min: 10,
					},
					notEmpty:
					{
						message: 'Please input your phone number'
					},
				}
			},
			contactformmessage:
			{
				validators:
				{
					stringLength:
					{
						min: 10,
						max: 200,
						message: 'Please enter at least 10 characters and no more than 200'
					},
					notEmpty:
					{
						message: 'Please input a message'
					}
				}
			},
			captcha:
			{
				validators:
				{
					callback:
					{
						message: 'Wrong answer',
						callback: function(value, validator, $field)
						{
							var items = $('#captchaOperation').html().split(' '),
								sum = parseInt(items[0]) + parseInt(items[2]);
							return value == sum;
						}
					}
				}
			}
		}
	});

});
