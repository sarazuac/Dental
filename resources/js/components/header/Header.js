import React from 'react';
import { Link } from 'react-router-dom';

const Header = () => (
    // <nav className="navbar navbar-expand-md navbar-light navbar-laravel">
    //     <div className="container">

    //     </div>

    // </nav>
    <nav className="navbar navbar-expand-lg navbar-light bg-light navbar-laravel">
        <a className="navbar-brand" href="#">
            Navbar
        </a>
        <button
            className="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span className="navbar-toggler-icon" />
        </button>
        <div className="collapse navbar-collapse" id="navbarNav">
            <ul className="navbar-nav">
                <Link className="navbar-brand" to="/timesheets">
                    Timesheets
                </Link>
                <Link className="navbar-brand" to="/clockin">
                    Clock In
                </Link>
                <li className="nav-item">
                    <a className="nav-link" href="#">
                        Pricing
                    </a>
                </li>
                <li className="nav-item">
                    <a className="nav-link disabled" href="#">
                        Disabled
                    </a>
                </li>
            </ul>
        </div>
    </nav>
);

export default Header;
