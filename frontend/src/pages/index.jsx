import { Navigate, Route, Routes } from "react-router-dom";

import LoginPage from "./login";
import { WaiterOrderPage, WaiterOrdersPage } from "./waiter";
import { ChefOrdersPage } from "./chef";
import {
  AdminDiscountsPage,
  AdminMenuPage,
  AdminOrderPage,
  AdminOrdersPage,
  AdminProductsPage,
  AdminReportsPage,
  AdminStaffPage
} from "./admin";
import NotFoundPage from "./not-found";

function Routing() {
  return (
    <Routes>
      <Route path="login" element={<LoginPage />}/>
      <Route path="waiter">
        <Route index element={<WaiterOrdersPage/>}/>
        <Route path={`order/:orderId`} element={<WaiterOrderPage/>}/>
      </Route>
      <Route path="chef">
        <Route index element={<ChefOrdersPage/>}/>
      </Route>
      <Route path="admin">
        <Route index element={<AdminOrdersPage/>}/>
        <Route path={`order/:orderId`} element={<AdminOrderPage/>}/>
        <Route path="products" element={<AdminProductsPage/>}/>
        <Route path="reports" element={<AdminReportsPage/>}/>
        <Route path="menu" element={<AdminMenuPage/>}/>
        <Route path="discounts" element={<AdminDiscountsPage/>}/>
        <Route path="staff" element={<AdminStaffPage/>}/>
      </Route>
      <Route path="404" element={<NotFoundPage/>}/>
      <Route path="*" element={<Navigate to="404"/>}/>
    </Routes>
  );
}

export default Routing;
