"use client";

import Link from "next/link";
import { Instagram, Linkedin } from "./Icons";

export default function Footer() {
  return (
    <footer className="bg-brand-bg py-20 px-6 md:px-24 border-t border-white/5">
      <div className="flex flex-col md:flex-row justify-between items-start md:items-end space-y-12 md:space-y-0">
        <div>
          <Link href="/" className="text-4xl font-heading font-black text-brand-gold tracking-tighter mb-6 block">
            JJ.
          </Link>
          <p className="text-brand-muted max-w-sm mb-8">
            Premium outdoor advertising across Bengaluru's most strategic corridors. Bold, beautiful, impossible to ignore.
          </p>
          <div className="flex space-x-6">
            <Link href="#" className="text-brand-muted hover:text-brand-gold transition-colors">
              <Instagram size={24} />
            </Link>
            <Link href="#" className="text-brand-muted hover:text-brand-gold transition-colors">
              <Linkedin size={24} />
            </Link>
          </div>
        </div>

        <div className="flex flex-col md:flex-row space-y-8 md:space-y-0 md:space-x-16 items-start md:items-end">
          <div className="flex flex-col space-y-4">
            <Link href="#services" className="text-sm uppercase tracking-widest font-bold hover:text-brand-gold">Services</Link>
            <Link href="#about" className="text-sm uppercase tracking-widest font-bold hover:text-brand-gold">About</Link>
            <Link href="#locations" className="text-sm uppercase tracking-widest font-bold hover:text-brand-gold">Locations</Link>
            <Link href="#contact" className="text-sm uppercase tracking-widest font-bold hover:text-brand-gold">Contact</Link>
          </div>
          <div className="text-brand-muted text-[10px] uppercase tracking-widest leading-loose">
            &copy; {new Date().getFullYear()} JJ Media House. <br />
            All rights reserved. <br />
            Bengaluru, India
          </div>
        </div>
      </div>
    </footer>
  );
}
