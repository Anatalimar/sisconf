import React, { useState } from 'react';
import Header from './components/Header';
import EventDetails from './components/EventDetails';
import RsvpForm from './components/RsvpForm';
import ConfirmationModal from './components/ConfirmationModal';
import Footer from './components/Footer';
import { Attendee } from './types';

function App() {
  const [confirmedAttendee, setConfirmedAttendee] = useState<Attendee | null>(null);

  const handleRsvpSubmit = (attendee: Attendee) => {
    // In a real application, you would send this data to a server
    console.log('RSVP submitted:', attendee);
    setConfirmedAttendee(attendee);
  };

  const handleCloseModal = () => {
    setConfirmedAttendee(null);
  };

  return (
    <div className="min-h-screen bg-white">
      <Header />
      <EventDetails />
      <RsvpForm onSubmit={handleRsvpSubmit} />
      <Footer />
      
      {confirmedAttendee && (
        <ConfirmationModal 
          attendee={confirmedAttendee} 
          onClose={handleCloseModal} 
        />
      )}
    </div>
  );
}

export default App;