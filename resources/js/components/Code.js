import React from 'react';
import ReactDOM from 'react-dom';
import QRCode from "react-qr-code";

function Code( props) {
    console.log(props.token)
    return (
        <QRCode value = { props.token } />
    );
}

export default Code;

if (document.getElementById('code')) {
    const component =  document.getElementById('code');
    const props = Object.assign({}, component.dataset)
    ReactDOM.render(<Code {...props} />, document.getElementById('code'));
}
