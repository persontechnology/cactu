import React,{useState,useEffect} from 'react';
import ReactDOM from 'react-dom';
import "@babel/polyfill";
import SpeechRecognition, { useSpeechRecognition } from 'react-speech-recognition';
import './ExampleStyle.css';
function Example() {
 
  

  const {
    transcript,
    interimTranscript,
    finalTranscript,
    resetTranscript,
    listening,
    browserSupportsSpeechRecognition
  } = useSpeechRecognition();

    useEffect(() => {
      if (finalTranscript !== '') {
      console.log('Got final result:', finalTranscript);
    }
    }, [interimTranscript, finalTranscript]);

    const listenContinuously = () => {
      SpeechRecognition.startListening({
        continuous: true,
      });
    };

  if (!browserSupportsSpeechRecognition) {
    return null;
  }

  return (
    <div className="textarea-container">
        
      <textarea className="form-control" id="respuesta" name="respuesta" placeholder="Redacte aquí..." id="respuesta" defaultValue={finalTranscript} rows="5"></textarea>
      <button id="microfono" className={ listening?'btn btn-danger btn-sm':'btn btn-success btn-sm'} type="button" onClick={listening ? SpeechRecognition.stopListening : listenContinuously}>
          <span className={listening?'lnr lnr-power-switch':'lnr lnr-mic'}></span>
        </button>
    </div>
  );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
