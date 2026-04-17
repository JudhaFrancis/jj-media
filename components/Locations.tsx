"use client";

import { motion } from "framer-motion";
import Link from "next/link";

const locations = [
  { name: 'Kamanahalli', traffic: '45K+/day', id: '01' },
  { name: 'Manyata Tech Park', traffic: '80K+/day', id: '02' },
  { name: 'Hebbal Flyover', traffic: '120K+/day', id: '03' },
  { name: 'Hennur Main Road', traffic: '60K+/day', id: '04' },
  { name: 'Devanahalli', traffic: '35K+/day', id: '05' },
];

export default function Locations() {
  return (
    <section id="locations" className="py-24 md:py-32 px-6 md:px-24">
      <div className="flex flex-col md:flex-row justify-between items-end mb-16 space-y-8 md:space-y-0 text-center md:text-left">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
        >
          <span className="text-brand-gold uppercase tracking-[0.3em] text-xs font-bold block mb-4">Inventory</span>
          <h2 className="text-5xl md:text-7xl font-heading font-black">Prime <span className="italic text-brand-gold">Inventory</span></h2>
          <p className="text-brand-muted mt-4 max-w-sm">Strategic sites across Bengaluru's highest-density corridors.</p>
        </motion.div>
        <motion.div
          initial={{ opacity: 0, x: 20 }}
          whileInView={{ opacity: 1, x: 0 }}
          viewport={{ once: true }}
        >
          <Link href="#contact" className="hidden md:block border-b border-brand-gold pb-2 text-brand-gold uppercase tracking-widest text-sm font-bold hover:scale-105 transition-transform">
            Inquire about availability
          </Link>
        </motion.div>
      </div>

      <div className="flex overflow-x-auto md:grid md:grid-cols-5 gap-6 no-scrollbar snap-x pb-8">
        {locations.map((loc, idx) => (
          <motion.div
            key={idx}
            initial={{ opacity: 0, scale: 0.95 }}
            whileInView={{ opacity: 1, scale: 1 }}
            viewport={{ once: true }}
            transition={{ delay: idx * 0.1 }}
            className="snap-center min-w-[280px] bg-brand-card p-8 border border-white/5 hover:border-brand-gold group transition-all duration-500 flex flex-col justify-between h-[400px]"
          >
            <div>
              <span className="text-4xl font-heading font-black text-brand-gold/10 group-hover:text-brand-gold/20 transition-colors block mb-4">
                {loc.id}
              </span>
              <h3 className="text-2xl font-heading font-black mb-4">{loc.name}</h3>
            </div>
            <div className="space-y-4">
              <span className="inline-block bg-brand-gold/10 text-brand-gold text-[10px] font-bold uppercase tracking-widest px-3 py-1">
                {loc.traffic}
              </span>
              <p className="text-xs text-brand-muted uppercase tracking-widest">Active Site</p>
            </div>
          </motion.div>
        ))}
      </div>
    </section>
  );
}
