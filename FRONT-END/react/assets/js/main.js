
const app = document.getElementById('app');
const root = ReactDOM.createRoot(app);

const button = React.createElement('button', 
  { type: 'button', onClick: () => getDataInput(), 'data-testid': 'my-button' }, 'Click Me');
const input = React.createElement('input', { type: 'text', id: 'input1', placeholder: 'Enter text', autoFocus: true });

const div = React.createElement('div', null, input, button);

root.render(div);

function getDataInput() {
  const input = document.getElementById('input1');
  console.log(input.value); 
  return
}

