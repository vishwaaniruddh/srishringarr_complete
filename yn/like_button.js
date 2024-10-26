'use strict';

const e = React.createElement;

function Coupon() {
    
    const[coupon,setCoupon] = React.useState('');
    const[isApplied,setIsApplied] = React.useState(false)
    const[message,setMessage] = React.useState('');
    const[messageClass,setMessageClass] = React.useState('');
    

    let handleReset = async () => {
        setIsApplied(false);
            const totalamount = document.getElementById('total_checkout_amount').innerHTML;
            document.getElementById('total_checkout_amount_og').innerHTML=totalamount;   
    }
    
    let handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const totalamount = document.getElementById('total_checkout_amount').innerHTML;
            let res = await fetch('https://yosshitaneha.com/api/couponRequest.php', {
                method: "POST",
                headers: {
                    'Content-type': 'application/json; charset=UTF-8',
                  },
                body: JSON.stringify({
                    'coupon': coupon,
                    'total_amount': totalamount,
                }),
            });
            let resJson = await res.json();
            
            if(resJson.response=='202'){
                document.getElementById('total_checkout_amount_og').innerHTML=resJson.result_amount;
                setIsApplied(true);
                setMessage(resJson.message);
                setMessageClass('alert alert-success');
            }else if(resJson.response=='302'){
                setMessage(resJson.message);
                setMessageClass('alert alert-danger');
            }
            else if(resJson.response=='402'){
                setMessage(resJson.message);
                setMessageClass('alert alert-danger');
            }
            
            else if(resJson.response=='502'){
                setMessage(resJson.message);
                setMessageClass('alert alert-danger');
            }

        }
        catch (err) {
            console.log(err);
        }
    };


        

    
    if(isApplied){
        return (
            React.createElement('div',{className:'row'},
            React.createElement('p',{className:messageClass},'Successfully Applied Coupon !'),
            React.createElement('button',{className:'btn btn-danger',onClick: () => handleReset(false)},'Reset'),
            )
            );
        
    }else{
        return (
            React.createElement('div', {className:'row'},
            React.createElement('div', {className: 'col-sm-6'},
            React.createElement('input', {className: 'form-control',type:'text',placeholder:'Enter Coupon ...',onChange:(e)=>setCoupon(e.target.value)},
            )),
            React.createElement('div', {className: 'col-sm-6'},
            React.createElement('input', {className: 'btn btn-success',type:'submit',name:'submit',onClick:handleSubmit},
            ))
            ,message ? React.createElement('p',{className:messageClass},message ?message :'' ) :''
        )

      );        
    }
    
  
}

const domContainer = document.querySelector('#coupon_container');
const root = ReactDOM.createRoot(domContainer);
root.render(e(Coupon));