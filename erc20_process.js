	const ethTx = require('ethereumjs-tx');
if (process.argv.length <= 2) {
    console.log("Usage: " + __filename + " SOME_PARAM");
    process.exit(-1);
}
 
var param = process.argv[2];
var contractdata = process.argv[3];

var from_address = process.argv[4];
var contract_address = process.argv[5];
var private_key = process.argv[6];

//console.log(param);



const txParams = {
  nonce: param, // Replace by nonce for your account on geth node
  gasPrice: '0x1A13B8600', //7000000000
  gasLimit: '0x30D40', //0x3D090
  to: contract_address, 
  from: from_address,
  value: '0x0',
  
  data: contractdata  
  
};
// Transaction is created
const tx = new ethTx(txParams);
const privKey = Buffer.from(private_key, 'hex');
// Transaction is signed
tx.sign(privKey);
const serializedTx = tx.serialize();
const rawTx = '0x' + serializedTx.toString('hex');
console.log(rawTx)