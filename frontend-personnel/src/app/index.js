import { Provider } from "react-redux";
import { BrowserRouter } from "react-router-dom";
import { ChakraProvider } from "@chakra-ui/react";

import Routing from "../pages";

import { store } from "../store";

function App() {
  return (
    <BrowserRouter basename='/personnel'>
      <Provider store={store}>
        <ChakraProvider>
          <Routing/>
        </ChakraProvider>
      </Provider>
    </BrowserRouter>
  );
}

export default App;
